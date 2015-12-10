<?php

/**
 * Created by PhpStorm.
 * User: Jean-Baptiste
 * Date: 07/09/2015
 * Time: 12:42
 */
class FormatDate {
	protected function affiche ($dateIn) {
		if (!empty($dateIn)) {
			if (strpos($dateIn, '-')) {
				$explode = '-';
				$date = explode($explode, $dateIn);
				if (strpos($date[2], ' ')) {
					$date[2] = substr($date[2], 0, strpos($date[2], ' '));
				}
				return $date[2] . '/' . $date[1] . '/' . $date[0];
			}
			else {
				$explode = '/';
				$date = explode($explode, $dateIn);
				if (strpos($date[2], ' ')) {
					$date[2] = substr($date[2], 0, strpos($date[2], ' '));
				}
				return $date[0] . '/' . $date[1] . '/' . $date[2];
			}
		}
		return '';
	}

	protected function SQL ($dateIn) {
		if (!empty($dateIn)) {
			if (strpos($dateIn, '/')) {
				$explode = '/';
				$date = explode($explode, $dateIn);
				if (strpos($date[2], ' ')) {
					$date[2] = substr($date[2], 0, strpos($date[2], ' '));
				}
				return $date[2] . '-' . $date[1] . '-' . $date[0];
			}
			else {
				$explode = '-';
				$date = explode($explode, $dateIn);
				if (strpos($date[2], ' ')) {
					$date[2] = substr($date[2], 0, strpos($date[2], ' '));
				}
				return $date[0] . '-' . $date[1] . '-' . $date[2];
			}
		}
		return '';
	}
}