<?php

namespace jCube\Notify;

interface Notifiable
{
	public function send();

	public function prevConfiguration();
}