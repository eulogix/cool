/**
 * @module stringUtil
 * A Module providing helper methods to work with strings.
 */
define(['dojo/date/locale'], function(locale) {
	'use strict';

	return {

		/**
		 * Make first character uppercase.
		 * @param {String} str
		 * @return {String}
		 */
		ucFirst: function(str) {
			return str.slice(0, 1).toUpperCase() + str.slice(1);
		},

		/**
		 * Format integer to display file size in kilobyte.
		 * @param {String} value
		 * @return {String} kilobyte
		 */
		formatFileSize: function(value) {
			var i = -1;
			var byteUnits = [' kB', ' Mb', ' Gb', ' Tb', 'Pb', 'Eb', 'Zb', 'Yb'];
			var fileSizeInBytes = value;
			do {
				fileSizeInBytes = fileSizeInBytes / 1024;
				i++;
			} while (fileSizeInBytes > 1024);

			return Math.max(fileSizeInBytes, 0).toFixed(1) + byteUnits[i];
		},


		/**
		 * Return file type.
		 * @param {string} value
		 * @return {String} directory or file
		 */
		formatType: function(value) {
			return value ? 'directory' : 'file';
		},

		/**
		 * Format date object.
		 * Date Integer value representing the number of milliseconds since 1 January 1970 00:00:00 UTC (Unix Epoch).
		 * @param value number of milliseconds
		 * @return {String} formatted date
		 */
		formatDate: function(value) {
			return locale.format(new Date(value), {
				datePattern: 'dd.MM.yyyy',
				timePattern: 'HH:mm'
			});
		}


	};
});