<?php

namespace LMS;

?><!DOCTYPE html>
<html>
	<head>
		<base href="/" />

		<link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
		<script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>

		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<link href="assets/style.css" type="text/css" rel="stylesheet" />
		<link href="assets/grid.css" type="text/css" rel="stylesheet" />
	</head>
	<body class="mdc-typography mdc-typography--body1 mdc-theme--dark">
		<aside class="mdc-drawer mdc-drawer--dismissible nav-drawer" id="nav-drawer">
			<div class="mdc-drawer__header">
				<div class="mdc-drawer__title">Main Navigation</div>
				<div class="mdc-drawer__subtitle">I get around</div>
			</div>
			<div class="mdc-drawer__content">
				<div class="mdc-list">
					<a class="mdc-list-item mdc-list-item--activated" href="#" aria-current="page">
						<span class="mdc-list-item__ripple"></span>
						<i class="material-icons mdc-list-item__graphic" aria-hidden="true">inbox</i>
						<span class="mdc-list-item__text">Inbox</span>
					</a>
					<a class="mdc-list-item" href="#">
						<span class="mdc-list-item__ripple"></span>
						<i class="material-icons mdc-list-item__graphic" aria-hidden="true">send</i>
						<span class="mdc-list-item__text">Outgoing</span>
					</a>
					<a class="mdc-list-item" href="#">
						<span class="mdc-list-item__ripple"></span>
						<i class="material-icons mdc-list-item__graphic" aria-hidden="true">drafts</i>
						<span class="mdc-list-item__text">Drafts</span>
					</a>
				</div>
			</div>
		</aside>
		<div class="mdc-drawer-app-content">
			<header class="mdc-top-app-bar app-bar" id="app-bar">
				<div class="mdc-top-app-bar__row">
					<section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
						<button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button">menu</button>
						<span class="mdc-top-app-bar__title">Application</span>
					</section>
				</div>
			</header>
			<main class="main-content" id="main-content">
				<div class="mdc-top-app-bar--fixed-adjust">
