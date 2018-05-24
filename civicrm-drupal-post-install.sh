# Download and install all assets.
cd vendor/civicrm/civicrm-core
bower install --allow-root
cd ../../../
# Move the necessary assets to the libraries directory.
asset_source=./vendor/civicrm/civicrm-core
asset_dest=./web/libraries/civicrm
mkdir -p $asset_dest
rsync -mr --include='*.'{html,js,css,svg,png,jpg,jpeg,ico,gif,woff,woff2,ttf,eot} --include='*/' --exclude='*' $asset_source/ $asset_dest/
rm -rf $asset_dest/tests
cp -r $asset_source/extern $asset_dest/
cp $asset_source/civicrm.config.php $asset_dest/
# Make sure we have permission to add the civicrm.settings.php file.
chmod 0775 web/sites/default