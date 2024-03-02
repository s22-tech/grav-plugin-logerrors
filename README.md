# Grav Log Errors Plugin

`Logerrors` is a [Grav](http://github.com/getgrav/grav) Plugin and records not found 404 errors to data folder.

This fork adds the visitors IP address to the log, as well as some code cleanup.


# Installation

Installing the Logerrors plugin can be done in one of two ways. Our GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file. 

## Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `logerrors`. You can find these files either on [GitHub](https://github.com/s22-tech/grav-plugin-logerrors).

You should now have all the plugin files under

    /your/site/grav/user/plugins/logerrors

>> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav), the [Error](https://github.com/getgrav/grav-plugin-error), the [Admin](https://github.com/getgrav/grav-plugin-admin) and [Data Manager](https://github.com/getgrav/grav-plugin-data-manager) plugins, and a theme to be installed in order to operate.

# Usage

`Logerrors` runs in the background and most of the time you will not know it is there. Although as soon as a 404 page not found is detected by the error plugin, the logerrors plugin will save the url, time and referer(if exists) to a data folder.

When enabled the Logerrors plugin will save data to two files:

- `/user/data/logerrors/notfound.txt`
  This file logs all 404 erros, it will save the url, the time and the HTTP_REFERER (if it exists).

- `/user/data/logerrors/summary_notfound.txt`
  This file will count the repetitive from the notfound.txt file and present it as a summary.

the folder name and the file name can be changed in configuration file or in the admin.

## Why save log to data folder?

When the log file is saved to the data folder in the yaml format, then data can be easily read in the Admin Data Manager section.


# Configuration

Simply copy the `user/plugins/logerrors/logerrors.yaml` into `user/config/plugins/logerrors.yaml` and make your modifications.

`enabled: true 				    // Enable or disable plugin`

`filename: not_found.txt		// override default file name`

`folder: logerrors				// override default folder name`


# Updating

Manually updating logerrors is pretty simple. Here is what you will need to do to get this done:

* Delete the `your/site/user/plugins/logerrors` directory.
* Downalod the new version of the Logerrors plugin from either [GitHub](https://github.com/s22-tech/grav-plugin-logerrors).
* Unzip the zip file in `your/site/user/plugins` and rename the resulting folder to `logerrors`.
* Clear the Grav cache. The simplest way to do this is by going to the admin and clicking the Clear cache button.  It can also be done by going to the root Grav directory in terminal and typing `bin/grav clear-cache`.

> Note: Any changes you have made to any of the files listed under this directory will also be removed and replaced by the new set. Any files located elsewhere (for example a YAML settings file placed in `user/config/plugins`) will remain intact.
