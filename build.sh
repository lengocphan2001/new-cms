rm -rf  ./public/index.html
rm -rf  ./public/assets
rm -rf  ./public/langs
npm run build
cp -r ./dist/* ./public