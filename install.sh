echo "Replit一键测试HTML&PHP脚本"
echo "脚本作者：ok8023"
echo "开源地址：https://github.com/ok8023/test/"

git clone https://github.com/ok8023/test && mv -b test/code/* ./ && mv -b test/code/.[^.]* ./ && rm -rf ./*~ &&  rm -rf ./code
echo "资源部署完毕"
echo "点击Run运行！"
