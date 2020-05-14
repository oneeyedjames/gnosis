<?php

namespace Bamboo\Controller;

interface Controller {
	// function getOne($params);
	// function getAll($params);
	function create($params);
	function update($params);
	function delete($params);
}
