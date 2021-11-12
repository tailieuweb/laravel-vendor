<?php namespace Foostart\Front\Controllers;

/*
|-------------------------------------------------------------------------------
| HomeController
|-------------------------------------------------------------------------------
| @author: Foostart
| @id: LPTE03
| @date: 11/04/2019
| @location: B111 - TDC
| @copyright: Foostart
|
*/

use Illuminate\Http\Request;
use URL,
    Route,
    Redirect;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

use Foostart\Category\Helpers\FooCategory;

use MatthiasMullie\Minify\CSS;
use MatthiasMullie\Minify\JS;

class FrontController extends Controller {

    //send data to view
    public $data_view = [
        'context_name' => NULL,
        'context_id' => NULL
    ];

    //package name
    public $package_name = 'package-front';

    //directory blocks
    public $root_source_blocks = NULL;
    public $dir_source_blocks = NULL;
    public $dir_target_blocks = NULL;

    //list of blocks id
    public $block_ids = [];

    //list of blocks id that using per page
    public $block_page_ids = [];

    //manage categories
    public $obj_category;

    //minify
    public $obj_css = NULL;
    public $obj_js = NULL;

    //current user
    public $user = NULL;
    public $user_id = NULL;
    public $user_full_name = NULL;
    public $user_email = NULL;
    public $token_api = NULL;

    //cache
    public $cache = NULL;


    /**
     * Constructor
     */
    public function __construct() {

        //set root source blocks
//        $this->root_source_blocks = realpath(config($this->package_name.'.dir.root_source_blocks'));
//
//        //set directory of list of blocks
//        $dir_source_blocks = config($this->package_name.'.dir.source_blocks');
//
//        if (!file_exists($dir_source_blocks)) {
//            mkdir($dir_source_blocks, 0755    , true);
//        }
//        $this->dir_source_blocks = realpath($dir_source_blocks);
//        $this->dir_target_blocks = realpath(__DIR__ . '/..');

        //object category
        $this->obj_category = new FooCategory();

        //load menu to header
        $params = [
            'order' => [
                'category_order' => 'ASC',
            ],
        ];
        $this->data_view['main_menu'] = $this->obj_category->getCategoriesByRef('main_menu', $params);//TODO: cache

        //minify
        $this->obj_css = new CSS();
        $this->obj_js = new JS();

        //cache config
        $this->cache = config($this->package_name.'.cache');
    }


    /**
     * Set user info
     * @author Kang
     * @date 23:30 14/03/2019
     * @add 305 TT
     * @param type $user
     * @return data view
     */
    public function setUserInfo($user) {

        $user = is_array($user) ? (object)$user : $user;
        $this->user_id = !empty($user->user_id) ? $user->user_id : NULL;
        $this->user_full_name = !empty($user->user_full_name) ? $user->user_full_name : 'Unknow';
        $this->user_email = !empty($user->user_email) ? $user->user_email : 'Unknow';
        $this->token_api = !empty($user->token_api) ? $user->token_api : NULL;

        $this->data_view = array_merge($this->data_view, array(
            'user_id' => $this->user_id,
            'user_full_name' => $this->user_full_name,
            'user_email' => $this->user_email,
            'token_api' => $this->token_api
        ));

        return $this->data_view;
    }
    /**
     * //TODO: cache user info
     * Get current logged user info
     * @return ARRAY user info
     * @date 28/12/2017
     */
    public function getUser() {

        $authentication = \App::make('authenticator');
        $profile_repository = \App::make('profile_repository');

        if ($user = $authentication->getLoggedUser()) {
            $this->user = $user;
            $this->user['user_id'] = $this->user['id'];

            $user_profile = $profile_repository->getFromUserId($this->user['id'])->toArray();

            $this->user['user_full_name'] = $user_profile['first_name'].' '.$user_profile['last_name'];

            unset($this->user['id']);
            unset($this->user['created_at']);
            unset($this->user['updated_at']);
        }

        return $this->user;
    }

    /**
     * Copy all files from source to target
     * @param STRING $source
     * @param STRING $target
     */
    public function xcopy($source, $target) {
        if (is_dir($source)) {
            $d = dir($source);
            while (FALSE !== ( $entry = $d->read() )) {
                if ($entry == '.' || $entry == '..') {
                    continue;
                }
                $_entry = $source . '/' . $entry;
                if (is_dir($_entry)) {
                    $_target =  $target . '/' . $entry;
                    if (!file_exists($_target)) {
                        mkdir($_target, 0755    , true);
                    }
                    $this->xcopy($_entry, $_target);
                    continue;
                }
                copy($_entry, $target . '/' . $entry);
            }

            $d->close();
        } else {
            if (!empty($source)) {
                copy($source, $target);
            }
        }
    }


    /**
     * Copy used block in projects from root source block
     */
    public function copyBlocks() {

        if (!config($this->package_name.'.dir.status')) {
            dd('stop');
        }

        $this->block_ids = config($this->package_name.'.block_ids');

        //Copy from directory source block
        foreach ($this->block_ids as $id) {

            //source
            $source_block_item = realpath($this->root_source_blocks.'/'.$id);

            //target
            $target_source_block_item = $this->dir_source_blocks.'/'.$id;
            if (!file_exists($target_source_block_item)) {
                mkdir($target_source_block_item, 0755    , true);
            }
            $target_source_block_item = realpath($target_source_block_item);


            //copy all content
            $this->xcopy($source_block_item, $target_source_block_item);

        }
    }

    /**
     * Copy list of assets: css, js, libs from source block to public assets
     */
    public function copy_assets($flag = true) {

        if ($flag) {
            $css = 'css';
            $js = 'js';
            $less = 'less';
        } else {
            $css = '_css';
            $js = '_js';
            $less = '_less';
        }

        //define list of using assets
        $page_config = config($this->package_name.'.page_config');

        //copy css from block to public system
        $env = env('APP_ENV');
        switch ($env) {
            case 'local':

                //copy block assets to public assets
                $dir_target_block_public = $this->dir_target_blocks . '/public';

                //CSS
                foreach ($this->block_ids as $_id) {

                    $source = realpath($this->dir_source_blocks . '/' . $_id . '/css/' . $_id . '.css');

                    if (!empty($source)) {

                        $dir_target = $dir_target_block_public . "/{$css}/blocks/";
                        if (!file_exists($dir_target)) {
                             mkdir($dir_target, 0755    , true);
                        }
                        $target = $dir_target . '/' . $_id . '.css';

                        copy($source, $target);
                    }
                }

                //LESS
                foreach ($this->block_ids as $_id) {

                    $source = realpath($this->dir_source_blocks . '/' . $_id . '/less/' . $_id . '.less');

                    if (!empty($source)) {

                        $dir_target = $dir_target_block_public . "/{$less}/blocks/";
                        if (!file_exists($dir_target)) {
                             mkdir($dir_target, 0755    , true);
                        }

                        $target = $dir_target . '/' . $_id . '.less';

                        copy($source, $target);
                    }
                }

                //JS
               foreach ($this->block_ids as $_id) {

                    $source = realpath($this->dir_source_blocks . '/' . $_id . '/js/' . $_id . '.js');

                    if (!empty($source)) {

                        $dir_target = $dir_target_block_public . "/{$js}/blocks/";
                        if (!file_exists($dir_target)) {
                             mkdir($dir_target, 0755    , true);
                        }

                        $target = $dir_target . '/' . $_id . '.js';

                        copy($source, $target);
                    }
                }

                //lib
                foreach ($page_config as $_page) {

                    foreach ($_page['libs'] as $_id => $_config) {

                        foreach ($_config as $_type => $_values) {

                            $type = $_type;

                            if (!$flag) {
                                $type = '_' . $_type;
                            }

                            switch ($_type) {
                                case 'js':
                                case 'css':

                                    foreach ($_values as $_item) {
                                        $_source = realpath($this->dir_source_blocks . '/' . $_id . '/' . $_type . '/' . $_item . '.' . $_type);

                                        if (!empty($_source)) {

                                            $dir_target = $dir_target_block_public . "/{$type}/blocks/";
                                            if (!file_exists($dir_target)) {
                                                 mkdir($dir_target, 0755    , true);
                                            }

                                            $_target = $dir_target . '/' . $_item . '.' . $_type;

                                            copy($_source, $_target);
                                        }
                                    }
                                    break;
                            }
                        }//end $_values
                    }//end $_config
                }//end $_page

                break;
            case 'production':
                break;
        }
    }

    /**
     * Copy background image from assets
     */
    public function copyBackgroundImage() {

        $bkg_images = [];
        $config_pages = $this->configBlockPageIds();

        $patterns = [
            'image' => '/url\([\'"]*\.\.\/images\/(.*?)[\'"]*\)/',
        ];
        //find list of background images
        foreach ($this->block_ids as $_id) {

            $dir_source_blocks_asset_css = $this->dir_target_blocks .'/public/css/blocks/' . $_id .'.css';

            if (file_exists($dir_source_blocks_asset_css)) {

                $css_content = file_get_contents($dir_source_blocks_asset_css);

                preg_match_all($patterns['image'], $css_content, $matches);
                if (!empty($matches[1])) {

                    foreach ($matches[1] as $image_name) {
                        if (!in_array($image_name, $bkg_images)) {
                            $bkg_images[] = $image_name;
                        }
                    }

                }
            }
        }

        //copy to css image
        if (!empty($bkg_images)) {

            foreach ($bkg_images as $image_name) {
                //source
                $_dir_source_block_image_backround = realpath($this->dir_target_blocks.'/public/images/'.$image_name);

                //target
                $dir_target = $this->dir_target_blocks.'/public/css/images';
                if (!file_exists($dir_target)) {
                    mkdir($dir_target, 0755    , true);
                }
                $_dir_target_block_image_background = realpath($dir_target) . '/' . $image_name;

                //copy
                $this->xcopy($_dir_source_block_image_backround, $_dir_target_block_image_background);
            }
        }

    }
    /**
     * Install blocks: copy blade, copy assets, copy images, copy background image
     */
    public function installBlocks() {

        //list of block ids
        $this->block_ids = config($this->package_name.'.block_ids');

        //target directory of blocks
        $dir_target_block_views = $this->dir_target_blocks . '/Views/blocks';
        if (!file_exists($dir_target_block_views)) {
                mkdir($dir_target_block_views, 0755    , true);
        }
        $dir_target_block_views = realpath($dir_target_block_views);

        /**
         * copy to blade content
         */
        foreach ($this->block_ids as $id) {
            //source content
            $_source = realpath($this->dir_source_blocks . '/' . $id . '/' . $id . '-content.php');
            $_target = $dir_target_block_views . '/' . $id . '-content.blade.php';
            if ($_source) {
                //Copy
                copy($_source, $_target);
                /**
                 * Override content
                 */
                //Remove php tag
                $content = file_get_contents($_target);
                $pattern = '/<\?php[\s\S]*?\?>/';
                $content = preg_replace($pattern, '', $content);

                //Update image path
                $pattern = '/src=".*?images/';
                $content = preg_replace($pattern, 'src="packages/foostart/package-front/images', $content);
                file_put_contents($_target, $content);
            }
        }

        /**
         * copy to images
         */
        $dir_target_block_images = $this->dir_target_blocks . '/public/images';
        if (!file_exists($dir_target_block_images)) {
                mkdir($dir_target_block_images, 0755    , true);
        }
        $_target = realpath($dir_target_block_images);

        foreach ($this->block_ids as $id) {
            //source images
            $_source = realpath($this->dir_source_blocks . '/' . $id . '/images');

            $this->xcopy($_source, $_target);
        }

        /**
         * Copy assets (css, js, libs) from block source
         */
        $this->copy_assets();

        /**
         * copy background image
         */
        $this->copyBackgroundImage();
    }

    /**
     * List of config all pages
     */
    public function configBlockPageIds() {
        $this->block_page_ids = [
            'home' => $this->getPageConfig('home'),
            'news_list' => $this->getPageConfig('news_list'),
            'news_detail' => $this->getPageConfig('news_detail'),
            'personnel_list' => $this->getPageConfig('personnel_list'),
            'personnel_detail' => $this->getPageConfig('personnel_detail'),
            'student_list' => $this->getPageConfig('student_list'),
            'student_detail' => $this->getPageConfig('student_detail'),
            'thematic_list' => $this->getPageConfig('thematic_list'),
            'thematic_detail' => $this->getPageConfig('personnel_detail'),
        ];
        return $this->block_page_ids;
    }

    /**
     * Get page config
     * @return ARRAY list of config assets
     */
    public function getPageConfig($page_name) {
        return config($this->package_name.'.page_config.'.$page_name);
    }

    /**
     * Get assets link by page name
     * @param STRING $page_name
     * @return STRING list of assets that using in page
     */
    public function getAssetPage($page_name) {
        $str_assets = '';
        $assets = $this->getPageConfig($page_name);

        $evn = env('APP_ENV');
        if ($evn == 'production') {
            //load link lib
            $url_asset_css = url('/packages/foostart/package-front/css/'.$page_name.'-styles.css');
            $str_css = '<link href="'.$url_asset_css.'" rel="stylesheet" type="text/css">';

            $url_asset_js = url('/packages/foostart/package-front/js/'.$page_name.'-scripts.js');
            $str_js = '<script src="'.$url_asset_js.'" type="text/javascript" async></script>';

            $str_assets = [
                $str_css,
                $str_js,
            ];
        } else {
            $str_assets = $this->_getAssetPage($assets, $page_name);
        }

        return $str_assets;
    }

    /**
     *
     * @param ARRAY $assets list of configs of page
     * @return STRING HTML CODE included css, js path
     */
    public function _getAssetPage($assets, $page_name) {
        $dirs = [];
        $str_assets = [];

        /**
         * core lib
         */
        //dir path
        $dirs['css'] = config($this->package_name.'.assets_lib.css');
        $dirs['js'] = config($this->package_name.'.assets_lib.js');

        //css
        foreach ($dirs['css'] as $_item) {
            $_dir_css = realpath(public_path($_item));
            //check existing file
            if ($_dir_css) {
                $url_asset_css = url($_item);
                $str_assets[] = '<link href="'.$url_asset_css.'" rel="stylesheet" type="text/css">';
            }
        }

        //js
        foreach ($dirs['js'] as $_item) {
            $_dir_css = realpath(public_path($_item));
            //check existing file
            if ($_dir_css) {
                $url_asset_js = url($_item);
                $str_assets[] = '<script src="'.$url_asset_js.'" type="text/javascript"></script>';
            }
        }

        /**
         * page lib
         */
        foreach ($assets['libs'] as $_id => $_asset) {

            foreach ($_asset as $_type => $_items) {

                foreach ($_items as $_item) {

                    //css
                    if ($_type == 'css') {

                        $_dir_css = realpath(public_path('packages/foostart/package-front/css/blocks/'.$_item.'.css'));

                        //check existing file
                        if ($_dir_css) {
                            $url_asset_css = url('/packages/foostart/package-front/css/blocks/'.$_item.'.css');
                            $str_assets[] = '<link href="'.$url_asset_css.'" rel="stylesheet" type="text/css">';

                            $dirs['css'][] = $_dir_css;
                        }
                    }

                    //js
                    if ($_type == 'js'){

                        $_dir_js = realpath(public_path('packages/foostart/package-front/js/blocks/'.$_item.'.js'));

                        //check existing file
                        if ($_dir_js) {
                            $url_asset_js = url('/packages/foostart/package-front/js/blocks/'.$_item.'.js');
                            $str_assets[] = '<script src="'.$url_asset_js.'" type="text/javascript"></script>';

                            $dirs['js'][] = $_dir_js;
                        }
                    }
                }
            }
        }

        //css
        if($assets && !empty($assets['ids'])) {
            foreach ($assets['ids'] as $id) {
                $_dir_css = realpath(public_path('packages/foostart/package-front/css/blocks/'.$id.'.css'));

                //check existing file
                if ($_dir_css) {
                    $url_asset_css = url('/packages/foostart/package-front/css/blocks/'.$id.'.css');
                    $str_assets[] = '<link href="'.$url_asset_css.'" rel="stylesheet" type="text/css">';

                    $dirs['css'][] = $_dir_css;
                }
            }
        }

        //js
        if($assets && !empty($assets['ids'])) {
            foreach ($assets['ids'] as $id) {
                $_dir_js = realpath(public_path('packages/foostart/package-front/js/blocks/'.$id.'.js'));

                //check existing file
                if ($_dir_js) {
                    $url_asset_js = url('/packages/foostart/package-front/js/blocks/'.$id.'.js');
                    $str_assets[] = '<script src="'.$url_asset_js.'" type="text/javascript"></script>';

                    $dirs['js'][] = $_dir_js;
                }
            }
        }


        //core lib
        $output_css = realpath(public_path('packages/foostart/package-front/css')).'/'.$page_name.'-styles.css';
        $output_js = realpath(public_path('packages/foostart/package-front/js')).'/'.$page_name.'-scripts.js';

        $this->minifyCSS($dirs['css'], $output_css);
        $this->minifyJS($dirs['js'], $output_js);

        //minify assets lib
        $this->minifyCSS($dirs['css'], $output_css);
        $this->minifyJS($dirs['js'], $output_js);

        return $str_assets;
    }

    /**
     *
     * @param type $dirs list of css file
     * @param STRING $output_path css output file
     */
    public function minifyCSS($dirs, $output_path) {

        $css_lib = config($this->package_name.'.assets_lib.css');

        foreach ($css_lib as $lib) {
            $dir_css = realpath(public_path($lib));
            $this->obj_css->add($dir_css);
        }

        //merger all the css files
        foreach ($dirs as $dir) {
            $this->obj_css->add($dir);
        }
        //output the file
        $this->obj_css->minify($output_path);

    }

        /**
     *
     * @param type $dirs list of JS file
     * @param STRING $output_path JS output file
     */
    public function minifyJS($dirs, $output_path) {

        $js_lib = config($this->package_name.'.assets_lib.js');

        foreach ($js_lib as $lib) {
            $dir_js = realpath(public_path($lib));
            $this->obj_js->add($lib);
        }

        //merger all the css files
        foreach ($dirs as $dir) {
            $this->obj_js->add($dir);
        }
        //output the file
        $this->obj_js->minify($output_path);

    }

    /**
     * Convert LESS to CSS
     */
    public function convertLESS2CSS(){
        $this->copy_assets(FALSE);
    }

}
