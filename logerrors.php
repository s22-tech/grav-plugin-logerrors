<?php
/**
 * LogErrors v1.1
 *
 * This plugin logs not found (404) page errors to the data folder so it can be read with Data Plugin.
 *
 * @package     Log Errors
 * @version     1.1
 * @link        <https://github.com/hugoaf/grav-plugin-logerrors>
 * @author      s22 Tech
 * @copyright   2024, s22 Tech
 * @author      Hugo Avila <hugoavila@sitioi.com>
 * @copyright   2015, Hugo Avila
 * @license     <http://opensource.org/licenses/MIT>        MIT
 */

namespace Grav\Plugin;

use Grav\Common\Plugin;
use RocketTheme\Toolbox\File\File;
use Symfony\Component\Yaml\Yaml;

class LogerrorsPlugin extends Plugin
{

	/**
	 * @return array
	 */
	public static function getSubscribedEvents() {
		return [
			'onPageNotFound' => ['onPageNotFound', 1],
		];
	}

	/**
	 *  If page is not found found, saves the occurence.
	 *
	 */
	public function onPageNotFound() {
		$this->uri = $this->grav['uri'];
		$this->savelog($this->uri->url);
	}

	/**
	 *  Saves data to the log file.
	 *  - creates or appends not found errors url, time, ip, and HTTP_REFERER.
	 *  - creates a summary and saves it to file.
	 */
	protected function savelog($url) {
		$params        = $this->config->get('plugins.logerrors');
		$filename      = !empty($params['filename']) ? trim($params['filename']) : 'not_found.txt';
		$folder        = !empty($params['folder'])   ? trim($params['folder'])   : 'error_logs';
		$locator       = $this->grav['locator'];
		$path          = $locator->findResource('user://data', true);
		$full_filename = $path . DS . $folder . DS . $filename;
		$file          = File::instance($full_filename);
		$ip            = isset($_SERVER['REMOTE_ADDR'])  ? $_SERVER['REMOTE_ADDR']  : '';
		$referer       = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
		$time          = date('Y-m-d h:i:sa');
		$vars          = [
			'URL'      => $url,
			'Time'     => $time,
			'Referrer' => $referer,
			'IP'       => $ip,
		];

		if (!file_exists($path . DS . $folder)) { mkdir($path . DS . $folder, 0755); }

		if (file_exists($full_filename)) {
			$data = (array) Yaml::parse($file->content());
			if (count($data) > 0) {
				array_unshift($data, $vars);
			}
			else {
				$data[] = $vars;
			}
		}
		else {
			$data[] = $vars;
		}

		$file->save(Yaml::dump($data));


	  //  Create a file and update the summary for recurrent notfound errors.
		$urls = array_column($data, 'URL');
		asort($urls);
		$summary    = [];
		$prev_value = ['URL' => null, 'Count' => null];
		foreach ($urls as $val) {
			if ($prev_value['URL'] !== $val) {
				unset($prev_value);
				$prev_value = ['URL' => $val, 'Count' => 0];
				$summary[]  = &$prev_value;
			}
			$prev_value['Count']++;
		}

		$count = [];
		foreach ($summary as $key => $row) {
			$count[$key] = $row['Count'];
		}

		array_multisort($count, SORT_DESC, $summary);

	  // Create file and save summary.
		$full_summary_filename = $path . DS . $folder . DS . 'summary_' . $filename;
		$file_summary = File::instance($full_summary_filename);

		$file_summary->save(Yaml::dump($summary));
	}
}
