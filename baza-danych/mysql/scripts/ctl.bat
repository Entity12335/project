@echo off
rem START or STOP Services
rem ----------------------------------
rem Check if argument is STOP or START

if not ""%1"" == ""START"" goto stop


"C:\Users\pc\Desktop\project\project\baza-danych\mysql\bin\mysqld" --defaults-file="C:\Users\pc\Desktop\project\project\baza-danych\mysql\bin\my.ini" --standalone
if errorlevel 1 goto error
goto finish

:stop
cmd.exe /C start "" /MIN call "C:\Users\pc\Desktop\project\project\baza-danych\killprocess.bat" "mysqld.exe"

if not exist "C:\Users\pc\Desktop\project\project\baza-danych\mysql\data\%computername%.pid" goto finish
echo Delete %computername%.pid ...
del "C:\Users\pc\Desktop\project\project\baza-danych\mysql\data\%computername%.pid"
goto finish


:error
echo MySQL could not be started

:finish
exit
