The project is built with laravel as well as django applications.
To start the servers you need to serve from two shells.
Steps :
1.1: Set correct baseDir in following code.
1.2: Add following aliases
2. Open Terminal
3. <code>startPortal1</code>
4. Open new tab Ctrl+T (in linux only)
5. <code>startPortal2</code>


You can add the following alias to your shell : 
(Change the directory to the place where you have cloned the code.)
#On Linux (/etc/bash.bashrc): 
<code>
	(change base dir according to your downloaded place)
	baseDir=$HOME/Downloads/dashboard_IITG;  
	appDir=$baseDir/laravel_projects
	djangoDir=$baseDir/Binder
	alias startPortal1="cd $appDir; php artisan serve --port 1234;";
	alias startPortal2="cd $djangoDir;python manage.py runserver;";
</code>
#On Windows : Create two Batch files as startPortal1.bat & startPortal2.bat and save it in C:\Windows\System32 
<code>
	set baseDir=C:\Users\Udayraj\Desktop\interIIT\final\dashboard_IITG
	set djangoDir=%baseDir%\Binder
	python %djangoDir%\manage.py runserver
</code>
<code>
	set baseDir=%USERPROFILE%\Downloads\dashboard_IITG
	set appDir=%baseDir%\laravel_projects
	set djangoDir=%baseDir%\Binder
	cd %appDir%; php artisan serve --port 1234;"cd %djangoDir%;python manage.py runserver;
</code>

for Database : import the sql file in 'others/' directory into a database 'dashboard'.
