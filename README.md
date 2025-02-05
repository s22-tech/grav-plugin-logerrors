# Grav Log Errors Plugin

`Logerrors` is a [Grav](http://github.com/getgrav/grav) Plugin and records 404 errors to your data folder.

This fork adds the visitors IP address to the log, as well as some code cleanup.


# Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `logerrors`. You can find these files [here](https://github.com/s22-tech/grav-plugin-logerrors).

You should now have all the plugin files under

    /your/site/grav/user/plugins/logerrors

> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav), the [Error](https://github.com/getgrav/grav-plugin-error), the [Admin](https://github.com/getgrav/grav-plugin-admin), [Data Manager](https://github.com/getgrav/grav-plugin-data-manager) plugins, and a theme to be installed in order to operate.

# Usage

`Logerrors` runs in the background and most of the time you will not know it is there. Although as soon as a 404 error is detected by the error plugin, the logerrors plugin will save the url, time, IP, and referer (if it exists) to a data folder.

When enabled the Logerrors plugin will save data to two files:

- `/user/data/logerrors/not_found.txt`
  This file logs all 404 erros, it will save the url, the time and the HTTP_REFERER (if it exists).

- `/user/data/logerrors/summary_not_found.txt`
  This file will count the repetitive from the not_found.txt file and present it as a summary.

the folder name and the file name can be changed in configuration file or in the admin.

## Why save log to data folder?

When the log file is saved to the data folder in the yaml format, then data can be easily read in the Admin Data Manager section.


# Configuration

Simply go to the logerrors plugin in the admin, make any changes, and then click the Save button.  Or to do it manually, copy the `user/plugins/logerrors/logerrors.yaml` into `user/config/plugins/logerrors.yaml` and make your modifications.

`enabled: true			// Enable or disable plugin`

`filename: not_found.txt	// override default file name`

`folder: logerrors		// override default folder name`


# Updating

Manually updating logerrors is pretty simple. Here is what you'll need to do:

* Delete the `your/site/user/plugins/logerrors` directory.
* Download the new version of the Logerrors plugin from either [GitHub](https://github.com/s22-tech/grav-plugin-logerrors).
* Unzip the zip file in `your/site/user/plugins` and rename the resulting folder to `logerrors`.
* Clear the Grav cache. The simplest way to do this is by going to the admin and clicking the Clear Cache button.  It can also be done manually by going to your root Grav directory in terminal and typing `bin/grav clear-cache`.

> Note: Any changes you have made to any of the files listed under this directory will also be removed and replaced by the new set. Any files located elsewhere (for example a YAML settings file placed in `user/config/plugins`) will remain intact.
