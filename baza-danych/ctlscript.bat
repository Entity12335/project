@echo off
rem START or STOP Services
rem ----------------------------------
rem Check if argument is STOP or START

if not ""%1"" == ""START"" goto stop

if exist C:\Users\pc\Desktop\project\project\baza-danych\hypersonic\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\server\hsql-sample-database\scripts\ctl.bat START)
if exist C:\Users\pc\Desktop\project\project\baza-danych\ingres\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\ingres\scripts\ctl.bat START)
if exist C:\Users\pc\Desktop\project\project\baza-danych\mysql\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\mysql\scripts\ctl.bat START)
if exist C:\Users\pc\Desktop\project\project\baza-danych\postgresql\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\postgresql\scripts\ctl.bat START)
if exist C:\Users\pc\Desktop\project\project\baza-danych\apache\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\apache\scripts\ctl.bat START)
if exist C:\Users\pc\Desktop\project\project\baza-danych\openoffice\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\openoffice\scripts\ctl.bat START)
if exist C:\Users\pc\Desktop\project\project\baza-danych\apache-tomcat\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\apache-tomcat\scripts\ctl.bat START)
if exist C:\Users\pc\Desktop\project\project\baza-danych\resin\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\resin\scripts\ctl.bat START)
if exist C:\Users\pc\Desktop\project\project\baza-danych\jetty\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\jetty\scripts\ctl.bat START)
if exist C:\Users\pc\Desktop\project\project\baza-danych\subversion\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\subversion\scripts\ctl.bat START)
rem RUBY_APPLICATION_START
if exist C:\Users\pc\Desktop\project\project\baza-danych\lucene\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\lucene\scripts\ctl.bat START)
if exist C:\Users\pc\Desktop\project\project\baza-danych\third_application\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\third_application\scripts\ctl.bat START)
goto end

:stop
echo "Stopping services ..."
if exist C:\Users\pc\Desktop\project\project\baza-danych\third_application\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\third_application\scripts\ctl.bat STOP)
if exist C:\Users\pc\Desktop\project\project\baza-danych\lucene\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\lucene\scripts\ctl.bat STOP)
rem RUBY_APPLICATION_STOP
if exist C:\Users\pc\Desktop\project\project\baza-danych\subversion\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\subversion\scripts\ctl.bat STOP)
if exist C:\Users\pc\Desktop\project\project\baza-danych\jetty\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\jetty\scripts\ctl.bat STOP)
if exist C:\Users\pc\Desktop\project\project\baza-danych\hypersonic\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\server\hsql-sample-database\scripts\ctl.bat STOP)
if exist C:\Users\pc\Desktop\project\project\baza-danych\resin\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\resin\scripts\ctl.bat STOP)
if exist C:\Users\pc\Desktop\project\project\baza-danych\apache-tomcat\scripts\ctl.bat (start /MIN /B /WAIT C:\Users\pc\Desktop\project\project\baza-danych\apache-tomcat\scripts\ctl.bat STOP)
if exist C:\Users\pc\Desktop\project\project\baza-danych\openoffice\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\openoffice\scripts\ctl.bat STOP)
if exist C:\Users\pc\Desktop\project\project\baza-danych\apache\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\apache\scripts\ctl.bat STOP)
if exist C:\Users\pc\Desktop\project\project\baza-danych\ingres\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\ingres\scripts\ctl.bat STOP)
if exist C:\Users\pc\Desktop\project\project\baza-danych\mysql\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\mysql\scripts\ctl.bat STOP)
if exist C:\Users\pc\Desktop\project\project\baza-danych\postgresql\scripts\ctl.bat (start /MIN /B C:\Users\pc\Desktop\project\project\baza-danych\postgresql\scripts\ctl.bat STOP)

:end

