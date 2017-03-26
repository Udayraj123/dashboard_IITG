
You can add the following alias to your shell : 
(Change the directory to the place where you have cloned the code.)

#On Linux (/etc/bash.bashrc): 
<code>
	(change base dir according to your downloaded place)
	baseDir=$HOME/Downloads/dashboard_IITG;  
	appDir=$baseDir/laravel_projects
	djangoDir=$baseDir/Binder
	alias startPortal="cd $appDir; php artisan serve --port 1234;"cd $djangoDir;python manage.py runserver;";
</code>
#On Windows : Create a Batch file as <alias_name>.bat (eg startPortal.bat) and save it in C:\Windows\System32 
<code>
	set baseDir = %USERPROFILE%\Downloads\dashboard_IITG
	set appDir = %baseDir%\laravel_projects
	set djangoDir = %baseDir%\Binder
	cd %appDir%; php artisan serve --port 1234;"cd %djangoDir%;python manage.py runserver;
</code>