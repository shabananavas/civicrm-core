# Download and install all assets.
asset_source=./vendor/civicrm/civicrm-core
asset_dest=$2
cd $asset_source
bower install --allow-root
# Move back to the project home directory.
cd $1
# Move the necessary assets to the libraries directory.
mkdir -p $asset_dest
rsync -mr --include='*.'{html,js,css,svg,png,jpg,jpeg,ico,gif,woff,woff2,ttf,eot} --include='*/' --exclude='*' $asset_source/ $asset_dest/
rm -rf $asset_dest/tests
cp -r $asset_source/extern $asset_dest/
cp $asset_source/civicrm.config.php $asset_dest/
