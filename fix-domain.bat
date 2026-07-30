@echo off
echo ==========================================
echo DNS Hosts Fixer for CMUR Training
echo ==========================================
echo.
findstr /C:"127.0.0.1 training.cmru.ac.th" %WINDIR%\System32\drivers\etc\hosts >nul
if %errorlevel% equ 0 (
    echo [OK] The domain is already in your hosts file.
) else (
    echo 127.0.0.1 training.cmru.ac.th >> %WINDIR%\System32\drivers\etc\hosts
    if %errorlevel% equ 0 (
        echo [SUCCESS] Domain added successfully!
        ipconfig /flushdns >nul
    ) else (
        echo [ERROR] Failed to add domain! 
        echo PLEASE RIGHT-CLICK THIS FILE AND SELECT "Run as administrator"
    )
)
echo.
pause
