<?php
class ImageMagick
{
	private $_commandList = array(
	);

	public function __construct($commandList)
	{
            $this->_commandList = $commandList;
	}
	private function _command($command)
	{
		$command = trim($command);
		return ((isset($this->_commandList[$command]))?$this->_commandList[$command]:$command);
	}
	
	
	public function convert($src, $dst, $options = '')
	{
		$command = $this->_command('convert').' '.$options.' "'.$src.'" "'.$dst.'"'; # 2>&1
		exec($command, $output, $res) ;
		@chmod($dst, 0777);
		return $res;
	}
        public function pdfToJpg($src, $dst, $options = '')
	{
		$command = $this->_command('convert').' '.$options.' "'.$src.'" "'.$dst.'"'; # 2>&1
		exec($command, $output, $res) ;
		@chmod($dst, 0777);
	}
	
	public function identify($file, $options = '')
	{
		$command = $this->_command('identify').' '.$options.' "'.$file.'"';
		exec($command, $output);
		return implode("\n", $output);
	}
	
	
	/**
	 * 
	 * @return image type 
	 * @param $file string 
	 */
	public function type($file)
	{
		return array_shift(explode(' ', trim($this->identify($file, '-format "%m "'))));
	}
	
	/**
	 * 
	 * @return assoc array with width and height keys 
	 * @param $file Object
	 */
	public function dimensions($file)
	{
		$dimensions = explode('x', array_shift(explode(' ', trim($this->identify($file, '-format "%wx%h "')))));
		if (count($dimensions)>1) {
			return array('width' => $dimensions[0], 'height' => $dimensions[1]);
		}
		else {
			return null;
		}
	}
	
	/**
	 * string for html tag, e.g. like for img one 
	 * @return 
	 * @param $file Object
	 */
	public function htmlAttributes($file)
	{
        $dimensions = $this->dimensions($file);
	    if (!is_null($dimensions)) {
		    return 'width="'.$dimensions['width'].'" height="'.$dimensions['height'].'"';
	    }
	    else {
		    return '';
	    } 
	}
	
	
	/**
	 * performs image resize 
	 * @return 0 in case of no error
	 * @param $src string 
	 * @param $dst string 
	 * @param $options string, e.g. '100x80">"'
	 */
	public function resize($src, $dst, $options)
	{
		return $this->convert($src, $dst, '-resize '.$options);
	}
	
	
	/**
	 * performs image resize with thumbnail option (remove all metadata)
	 * @return 0 in case of no error
	 * @param $src string 
	 * @param $dst string 
	 * @param $options string, e.g. '100x80">"'
	 */
	public function thumbnail($src, $dst, $options)
	{
                return $this->convert($src, $dst, '-thumbnail '.$options);
	}
	
	
	/**
	 * performs image crop
	 * @return 0 in case of no error
	 * @param $src string 
	 * @param $dst string 
	 * @param $options string, e.g. '100x80'
	 */
	public function crop($src, $dst, $options)
	{
		return $this->convert($src, $dst, '-crop '.$options);
	}
	
	
	/**
	 * performs smart crop, result is always of exact size and crop is calculated 
	 * @return 
	 * @param $src string 
	 * @param $dst string 
	 * @param $dimensions string, e.g. '100x80'
	 */
	public function cropSmart($src, $dst, $dimensions)
	{
		$dimensionsActual = $this->dimensions($src);
		$dimensionsRequired = explode('x', $dimensions);
		
		// resize by smallest dimension
		$resize = array();
		if ($dimensionsActual['width'] > $dimensionsActual['height']) {
			$resize['height'] = $dimensionsRequired[1];
			$resize['width'] = round($dimensionsActual['width'] * $resize['height'] / $dimensionsActual['height']);			
		}
		else {
			$resize['width'] = $dimensionsRequired[0];
			$resize['height'] = round($dimensionsActual['height'] * $resize['width'] / $dimensionsActual['width']);
		}
		
		if ($resize['width'] < $dimensionsRequired[0]) {
			$resize['height'] = round($dimensionsRequired[0] * $dimensionsRequired[1] / $resize['width']);
			$resize['width'] = $dimensionsRequired[0];
		}
		elseif ($resize['height'] < $dimensionsRequired[1]) {
			$resize['width'] = round($dimensionsRequired[0] * $dimensionsRequired[1] / $resize['height']);
			$resize['height'] = $dimensionsRequired[1];
		}
		
		$this->thumbnail($src, $dst, $resize['width'].'x'.$resize['height']);
		
		// get new dimensions
		$dimensionsActual = $this->dimensions($dst);
		
		// centered crop 
		$cropShift = array(
			'x' => ($dimensionsActual['width'] / 2) - ($dimensionsRequired[0] / 2), 
			'y' => ($dimensionsActual['height'] / 2) - ($dimensionsRequired[1] / 2)
		);
		
		return $this->crop($dst, $dst, $dimensions.'+'.$cropShift['x'].'+'.$cropShift['y']);
	}
	
}
?>
