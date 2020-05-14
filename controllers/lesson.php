<?php

namespace LMS\Controller;

use LMS\Model\LessonModel;

class LessonController extends EntityController {
	protected function getBaseRoute() {
		return '/lessons';
	}

	protected function getModel($data = []) {
		return new LessonModel($data);
	}
}
