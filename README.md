
You can add the following alias to your shell : 
(Change the directory to the place where you have cloned the code.)

On Linux (/etc/bash.bashrc): 
<code>
appDir=$HOME/Downloads/dashboard_IITG

alias startPortal=";;";

## declare an array of php apps to serve
declare -a arr=("element1" "element2" "element3")

## now loop through the above array
for i in "${arr[@]}"
do
   cd $appDir/"$i"
   php artisan serve
done

# You can access them using echo "${arr[0]}", "${arr[1]}" also

</code>
On Windows : Create a Batch file in C:\Windows\System32
set appDir = %USERPROFILE%\Downloads\dashboard_IITG