echo "$(tput setaf 6)" &&

echo 'Building production version...' &&

npm run production
echo -ne 'Production version created......              (30%)\r'

rm -rf build
mkdir -p build/memberpress-two-tier-recurring-addon #multiple folder creation

echo -ne 'Cleanup and building files started........            (40%)\r'

rsync -r --exclude '.git' --exclude '.svn' --exclude 'build' --exclude 'node_modules' --exclude 'dev' --exclude '.vscode' . build/review-booster/

echo -ne 'Files copied............        (60%)\r'

rm -rf build/memberpress-two-tier-recurring-addon/mix-manifest.json &&
rm -rf build/memberpress-two-tier-recurring-addon/package.json &&
rm -rf build/memberpress-two-tier-recurring-addon/package-lock.json &&
rm -rf build/memberpress-two-tier-recurring-addon/webpack.mix.js &&
rm -rf build/memberpress-two-tier-recurring-addon/.babelrc &&
rm -rf build/memberpress-two-tier-recurring-addon/.gitignore &&
find . -type f -name '*.DS_Store' -ls -delete &&
rm -rf build/memberpress-two-tier-recurring-addon/.AppleDouble &&
rm -rf build/memberpress-two-tier-recurring-addon/.LSOverride &&
rm -rf build/memberpress-two-tier-recurring-addon/.Trashes &&
rm -rf build/memberpress-two-tier-recurring-addon/.AppleDB &&
rm -rf build/memberpress-two-tier-recurring-addon/.idea &&
rm -rf build/memberpress-two-tier-recurring-addon/build.sh &&
rm -rf build/memberpress-two-tier-recurring-addon/yarn.lock &&
rm -rf build/memberpress-two-tier-recurring-addon/composer.json &&
rm -rf build/memberpress-two-tier-recurring-addon/composer.lock &&
rm -rf build/memberpress-two-tier-recurring-addon/task.txt &&
rm -rf build/memberpress-two-tier-recurring-addon/phpcs.xml &&

find . -type f -name '*.LICENSE.txt' -ls -delete &&

echo -ne 'Creating memberpress-two-tier-recurring-addon.zip file................    (80%)'

cd build
zip -r memberpress-two-tier-recurring-addon.zip memberpress-two-tier-recurring-addon/.
rm -r memberpress-two-tier-recurring-addon

echo -ne 'Congratulations... Successfully done....................(100%)'

npm run development
echo -ne 'Development version restored....................(100%)\r'

echo "$(tput setaf 2)" &&
echo "Clean process completed!"
echo "$(tput sgr0)"