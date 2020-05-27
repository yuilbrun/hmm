@echo off
title BY 独自等待 www.waitalone.cn
echo ====================================
echo.
echo     批量获取主机名对应的ip地址
echo.
echo    BY 独自等待 www.waitalone.cn
echo.
echo ====================================
color a
for /f %%a in (ok.txt) do (
    echo.
    echo 正在获取%%a的ip地址，请稍候……
    ping %%a -4 -n 1 |find /i "ping" > %%a.txt
    for /f "tokens=2 delims=[]" %%b in (%%a.txt) do @echo %%b >> result.txt
    del /f /q %%a.txt
)
echo.
pause