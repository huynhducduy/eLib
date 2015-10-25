<?php
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	require_once('../../assets/config.php');
	if ($_SESSION["admin"] != 1) die();
	$error = array(
	    'error' => 'success',
		'bookid' => '0',
		'bookname' => '0',
		'bookdescription' => '0',
		'bookshortdescription' => '0',
		'bookkeyword' => '0',
		'bookcate' => '0',
		'bookbcode' => '0',
		'booknumber' => '0',
		'bookauthor' => '0',
		'bookpagen' => '0',
		'booklang' => '0',
		'bookimages1' => '0',
		'done' => '0'
	);
	function is_number($s)
	{
		if(preg_match('/^([0-9]+)$/',$s) == '1') {return true;} else {return false;}
	}
	if (($_POST['bookid'] == NULL) || (!is_number(($_POST['bookid']))))
	{
		$error['bookid']='1';
	}
	else
	{
		if ($_POST['bookname'] == NULL)
		{
			$error['bookname']='1';
		}
		else
		{
			if ($_POST['bookdescription'] == NULL)
			{
				$error['bookdescription']='1';
			}
			else
			{
				if ($_POST['bookshortdescription'] == NULL)
				{
					$error['bookshortdescription']='1';
				}
				else
				{
					if ($_POST['bookkeyword'] == NULL)
					{
						$error['bookkeyword']='1';
					}
					else
					{
						if (($_POST['bookcate'] == NULL) || (!is_number(($_POST['bookcate']))))
						{
							$error['bookcate']='1';
						}
						else
						{
							$sqlktcate="SELECT * FROM `cate2` WHERE `id`='".$_POST['bookcate']."'";
							$queryktcate=@mysql_query($sqlktcate);
							if (@mysql_num_rows($queryktcate) == 0)
							{
								$error['bookcate']=$_POST['bookcate'];
							}
							else
							{
								if ($_POST['bookbcode'] == NULL)
								{
									$error['bookbcode']='1';
								}
								else
								{
									$sqlktbcode="SELECT * FROM `book` WHERE `bcode`='".$_POST['bookbcode']."'";
									$queryktbcode=@mysql_query($sqlktbcode);
									$rowktbcode=@mysql_fetch_assoc($queryktbcode);
									if ((@mysql_num_rows($queryktbcode) != 0) && ($rowktbcode['id'] != $_POST['bookid']))
									{
										$error['bookbcode']='2';
									}
									else
									{
										if ($_POST['booknumber'] == NULL)
										{
											$error['booknumber']='1';
										}
										else
										{
											if (!is_number($_POST['booknumber']))
											{
												$error['booknumber']='2';
											}
											else
											{
												if ($_POST['bookauthor'] == NULL)
												{
													$error['bookauthor']='1';
												}
												else
												{
													if ($_POST['bookpagen'] == NULL)
													{
														$error['bookpagen']='1';
													}
													else
													{
														if (!is_number($_POST['bookpagen']))
														{
															$error['bookpagen']='2';
														}
														else
														{ 
															if ($_POST['booklang'] == NULL)
															{
																$error['booklang']='1';
															}
															else
															{
																if (($_POST['booklang'] != '0') && ($_POST['booklang'] != '1') && ($_POST['booklang'] != '2') && ($_POST['booklang'] != '3') && ($_POST['booklang'] != '4') && ($_POST['booklang'] != '5') && ($_POST['booklang'] != '6') && ($_POST['booklang'] != '7'))
																{
																	$error['booklang']='2';
																}
																else
																{
																	if ($_POST['bookimages1'] == NULL)
																	{
																		$error['bookimages1']='1';
																	}
																	else
																	{
																		$sql="UPDATE `book` SET `cid`='".$_POST['bookcate']."',`title`='".$_POST['bookname']."',`des`='".$_POST['bookshortdescription']."',`description`='".$_POST['bookdescription']."',`number`='".$_POST['booknumber']."',`img1`='".$_POST['bookimages1']."',`img2`='".$_POST['bookimages2']."',`img3`='".$_POST['bookimages3']."',`img4`='".$_POST['bookimages4']."',`img5`='".$_POST['bookimages5']."',`img6`='".$_POST['bookimages6']."',`keyword`='".$_POST['bookkeyword']."',`bcode`='".$_POST['bookbcode']."',`publisher`='".$_POST['bookpublisher']."',`publish-time`='".$_POST['bookpublishtime']."',`author`='".$_POST['bookauthor']."',`pagen`='".$_POST['bookpagen']."',`lang`='".$_POST['booklang']."',`new`='".$_POST['booklabelnew']."',`hot`='".$_POST['booklabelhot']."',`recommended`='".$_POST['booklabelrec']."',`proofread`='".$_POST['bookproofread']."' WHERE `id`='".$_POST['bookid']."'";
																		mysql_query($sql);
																		$error['done']='1';
																	}
																}
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
}
die (json_encode($error));
?>