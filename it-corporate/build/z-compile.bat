pushd %~dp0
::cd /d %~dp0

::sass --watch -t expanded style.scss:../css/style.css
::sass --watch -t nested style.scss:../css/style.css
::sass --watch -t compact style.scss:../css/style.css
::sass --watch -t compressed style.scss:../css/style.css

gulp
