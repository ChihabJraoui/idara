<?php

namespace Objects;

class Pagination
{
	private $num_records;
	private $num_records_par_page;
	private $current_page;
	private $link;

	const LINK_FORUM = 1;
	const LINK_FAVORITE = 2;

	public function __construct()
	{
		if(!empty($_GET["pg"]))
		{
			$this->current_page = intval($_GET["pg"]);
		}
		else
		{
			$this->current_page = 1;
		}
	}


	/*
	 * Getters
	 */
	private function getNumRecords()             { return $this->num_records; }
	private function getNumRecordsParPage()      { return $this->num_records_par_page; }
	private function getLink()                   { return $this->link; }
	private function getNumPages()               { return ceil($this->num_records / $this->num_records_par_page); }


	/*
	 * Setters
	 */
	public function setNumRecords($val)         { $this->num_records = $val; }
	public function setNumRecordsParPage($val)  { $this->num_records_par_page = $val; }

	public function setLink($pageType, $id = null)
	{
		$pageLink = "";

		switch($pageType)
		{
			case 1: $pageLink = \Config::getLink('ForumLink'); break;
			case 2: $pageLink = \Config::getLink('FavoriteLink'); break;
		}

		$this->link = $pageLink . $id;
	}


	/*
     * Methods
	 *
	 */
	private function getPrevious()
	{
		if($this->current_page == 1)
		{
			return'
			<li>
				<a>
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</li>';
		}
		else
		{
			return'
			<li>
				<a href="'.$this->link.'?pg='.($this->current_page - 1).'">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</li>';
		}
	}

	public function getSqlLimit()
	{
		return (($this->current_page - 1) * $this->num_records_par_page) . ", " . $this->num_records_par_page;
	}

	private function getNext()
	{
		if($this->current_page == $this->getNumPages())
		{
			return'
			<li>
				<a>
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
			</li>';
		}
		else
		{
			return'
			<li>
				<a href="'.$this->link.'?pg='.($this->current_page + 1).'">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
			</li>';
		}
	}

	/*
	 * Render Pagination
	 *
	 */
	public function render()
	{
		$numPgs = $this->getNumPages();

		 //Render Pagination when there are more than 1 page
		if($numPgs > 1)
		{
			echo '
			<div style="text-align: center; width: 100%;">
				<ul class="pagination pagination-sm">
					' . $this->getPrevious();

				for ($i = 1; $i <= $numPgs; $i++)
				{
					echo '
					<li' . ($this->current_page == $i ? ' class="active"' : '') . '>
						<a href="' . $this->link . '?pg=' . $i . '">' . $i . '</a>
					</li>';
				}

				echo $this->getNext() . '
				</ul>
			</div>';
		}
	}
}

//<span class="pull-left flip">الصفحة ' . $this->current_page . ' من ' . $numPgs . '</span>