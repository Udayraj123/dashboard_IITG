<?php
	function custom_sanitise($input)
	{
		// return trim(stripslashes(strip_tags($input)));
		// return trim($input);
		return $input;
	}
	function contains_only($input,$allowed)
	{
		$ans = true;
		$regex = "/^[a-zA-Z0-9 _.]+$/";
		if(preg_match($regex,$input)==false)
		{
			$ans = false;
		}
		if(count($allowed)>0)
		{
			if(in_array('a',$allowed)==false)
			{
				$regex = "/^[A-Z0-9 _.]+$/";
				if(preg_match($regex,$input)==false)
					$ans = false;
			}
			if(in_array('A',$allowed)==false)
			{
				$regex = "/^[a-z0-9 _.]+$/";
				if(preg_match($regex,$input)==false)
					$ans = false;
			}
			if(in_array('0',$allowed)==false)
			{
				$regex = "/^[a-zA-Z _.]+$/";
				if(preg_match($regex,$input)==false)
					$ans = false;
			}
			if(in_array(' ',$allowed)==false)
			{
				$regex = "/^[a-zA-Z0-9_.]+$/";
				if(preg_match($regex,$input)==false)
					$ans = false;
			}
			if(in_array('_',$allowed)==false)
			{
				$regex = "/^[a-zA-Z0-9 .]+$/";
				if(preg_match($regex,$input)==false)
					$ans = false;
			}
			if(in_array('.',$allowed)==false)
			{
				$regex = "/^[a-zA-Z0-9 _]+$/";
				if(preg_match($regex,$input)==false)
					$ans = false;
			}
		}
		return $ans;
	}
	function getPlaceName($code)
	{
		$ans = '';
		switch ($code)
		{
			case 'cam': $ans = 'campus'; break;
			case 'air': $ans = 'airport'; break;
			case 'mrs': $ans = 'main railway station'; break;
			case 'krs': $ans = 'kamakhya railway station'; break;
			default: $ans = ''; break;
		}
		return $ans;
	}
?>