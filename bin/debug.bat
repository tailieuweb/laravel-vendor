@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../foostart/package-filemanager/bin/debug
php "%BIN_TARGET%" %*
