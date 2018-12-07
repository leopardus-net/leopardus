<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">

        <title>The Leopardus system</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

						@-webkit-keyframes scaleAnimation {
							0% {
								opacity: 0;
								-webkit-transform: scale(1.5);
												transform: scale(1.5);
							}
							100% {
								opacity: 1;
								-webkit-transform: scale(1);
												transform: scale(1);
							}
						}

						@keyframes scaleAnimation {
							0% {
								opacity: 0;
								-webkit-transform: scale(1.5);
												transform: scale(1.5);
							}
							100% {
								opacity: 1;
								-webkit-transform: scale(1);
												transform: scale(1);
							}
						}
						@-webkit-keyframes drawCircle {
							0% {
								stroke-dashoffset: 151px;
							}
							100% {
								stroke-dashoffset: 0;
							}
						}
						@keyframes drawCircle {
							0% {
								stroke-dashoffset: 151px;
							}
							100% {
								stroke-dashoffset: 0;
							}
						}
						@-webkit-keyframes drawCheck {
							0% {
								stroke-dashoffset: 36px;
							}
							100% {
								stroke-dashoffset: 0;
							}
						}
						@keyframes drawCheck {
							0% {
								stroke-dashoffset: 36px;
							}
							100% {
								stroke-dashoffset: 0;
							}
						}
						@-webkit-keyframes fadeOut {
							0% {
								opacity: 1;
							}
							100% {
								opacity: 0;
							}
						}
						@keyframes fadeOut {
							0% {
								opacity: 1;
							}
							100% {
								opacity: 0;
							}
						}
						@-webkit-keyframes fadeIn {
							0% {
								opacity: 0;
							}
							100% {
								opacity: 1;
							}
						}
						@keyframes fadeIn {
							0% {
								opacity: 0;
							}
							100% {
								opacity: 1;
							}
						}

						#successAnimationCircle {
							stroke-dasharray: 151px 151px;
							stroke: #329e18;
						}

						#successAnimationCheck {
							stroke-dasharray: 36px 36px;
							stroke: #329e18;
						}

						#successAnimationResult {
							fill: #329e18;
							opacity: 0;
						}

						#successAnimation.animated {
							-webkit-animation: 1s ease-out 0s 1 both scaleAnimation;
											animation: 1s ease-out 0s 1 both scaleAnimation;
						}

						#successAnimation.animated #successAnimationCircle {
							-webkit-animation: 1s cubic-bezier(0.77, 0, 0.175, 1) 0s 1 both drawCircle, 0.3s linear 0.9s 1 both fadeOut;
											animation: 1s cubic-bezier(0.77, 0, 0.175, 1) 0s 1 both drawCircle, 0.3s linear 0.9s 1 both fadeOut;
						}

						#successAnimation.animated #successAnimationCheck {
							-webkit-animation: 1s cubic-bezier(0.77, 0, 0.175, 1) 0s 1 both drawCheck, 0.3s linear 0.9s 1 both fadeOut;
											animation: 1s cubic-bezier(0.77, 0, 0.175, 1) 0s 1 both drawCheck, 0.3s linear 0.9s 1 both fadeOut;
						}

						#successAnimation.animated #successAnimationResult {
							-webkit-animation: 0.3s linear 0.9s both fadeIn;
											animation: 0.3s linear 0.9s both fadeIn;
						}

						.text-title {
							margin-top: 2px;
							position: absolute;
							margin-left: 15px;
						}

						.help-link {
							font-size:11px;
							border: 1px solid;
							border-radius: 50%;
							height: 15px; 
							width: 15px;
							display: inline-block;
							text-align: center;
							text-decoration: none;
							float:right;
							margin-left: 15px;
							margin-top: 5px;
						}

						.item {
							margin:8px 0;
							position: relative;
						}

						.item > strong {
							margin-left:35px;
						}

						.danger-icon {
							position: absolute;
							width: 25px;
							margin-left: 3px;
						}

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height" style="">
        	<div class="content" style="margin-top: -8em">
        		<h1>The Leopardus System</h1>
                <img style="float:left;width: 120px;" src="./assets/images/leopardus-face.png" alt="The Leopardus system">
            	<div style="float:left;text-align: left;margin-left: 15px;margin-bottom: 15px">
            		<h3 class="item">
            			<?php if($this->checkVersionPHP()): ?> 
	            		<svg class="animated" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 70 70" style="position: absolute;top: -3px;">
						  <path id="successAnimationResult" fill="#D8D8D8" d="M35,60 C21.1928813,60 10,48.8071187 10,35 C10,21.1928813 21.1928813,10 35,10 C48.8071187,10 60,21.1928813 60,35 C60,48.8071187 48.8071187,60 35,60 Z M23.6332378,33.2260427 L22.3667622,34.7739573 L34.1433655,44.40936 L47.776114,27.6305926 L46.223886,26.3694074 L33.8566345,41.59064 L23.6332378,33.2260427 Z"/>
						  <circle id="successAnimationCircle" cx="35" cy="35" r="24" stroke="#979797" stroke-width="2" stroke-linecap="round" fill="transparent"/>
						  <polyline id="successAnimationCheck" stroke="#979797" stroke-width="2" points="23 34 34 43 47 27" fill="transparent"/>
						</svg>
						<?php else: ?>
							<img class="danger-icon" src="./assets/images/danger.png" alt="X">
						<?php endif; ?>
	            		<strong>PHP versión check</strong>
	            		<a href="#" title="Help" class="help-link">?</a>
	            	</h3>

	            	<h3 class="item">
	            		<?php if($this->checkSettingsPHP()): ?> 
	            		<svg class="animated" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 70 70" style="position: absolute;top: -3px;">
						  <path id="successAnimationResult" fill="#D8D8D8" d="M35,60 C21.1928813,60 10,48.8071187 10,35 C10,21.1928813 21.1928813,10 35,10 C48.8071187,10 60,21.1928813 60,35 C60,48.8071187 48.8071187,60 35,60 Z M23.6332378,33.2260427 L22.3667622,34.7739573 L34.1433655,44.40936 L47.776114,27.6305926 L46.223886,26.3694074 L33.8566345,41.59064 L23.6332378,33.2260427 Z"/>
						  <circle id="successAnimationCircle" cx="35" cy="35" r="24" stroke="#979797" stroke-width="2" stroke-linecap="round" fill="transparent"/>
						  <polyline id="successAnimationCheck" stroke="#979797" stroke-width="2" points="23 34 34 43 47 27" fill="transparent"/>
						</svg>
						<?php else: ?>
							<img class="danger-icon" src="./assets/images/danger.png" alt="X">
						<?php endif; ?>

	            		<strong>PHP settings check</strong>
	            		<a href="#" title="Help" class="help-link">?</a>
	            	</h3>
	            	<h3 class="item">
	            		<?php if($this->checkExtensionsPHP()): ?> 
	            		<svg class="animated" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 70 70" style="position: absolute;top: -3px;">
						  <path id="successAnimationResult" fill="#D8D8D8" d="M35,60 C21.1928813,60 10,48.8071187 10,35 C10,21.1928813 21.1928813,10 35,10 C48.8071187,10 60,21.1928813 60,35 C60,48.8071187 48.8071187,60 35,60 Z M23.6332378,33.2260427 L22.3667622,34.7739573 L34.1433655,44.40936 L47.776114,27.6305926 L46.223886,26.3694074 L33.8566345,41.59064 L23.6332378,33.2260427 Z"/>
						  <circle id="successAnimationCircle" cx="35" cy="35" r="24" stroke="#979797" stroke-width="2" stroke-linecap="round" fill="transparent"/>
						  <polyline id="successAnimationCheck" stroke="#979797" stroke-width="2" points="23 34 34 43 47 27" fill="transparent"/>
						</svg>
						<?php else: ?>
							<img class="danger-icon" src="./assets/images/danger.png" alt="X">
						<?php endif; ?>

	            		<strong>PHP extension check</strong>
	            		<a href="#" title="Help" class="help-link">?</a>
	            	</h3>
	            	<h3 class="item">
	            		<?php if($this->checkFilesPermission()): ?> 
	            		<svg class="animated" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 70 70" style="position: absolute;top: -3px;">
						  <path id="successAnimationResult" fill="#D8D8D8" d="M35,60 C21.1928813,60 10,48.8071187 10,35 C10,21.1928813 21.1928813,10 35,10 C48.8071187,10 60,21.1928813 60,35 C60,48.8071187 48.8071187,60 35,60 Z M23.6332378,33.2260427 L22.3667622,34.7739573 L34.1433655,44.40936 L47.776114,27.6305926 L46.223886,26.3694074 L33.8566345,41.59064 L23.6332378,33.2260427 Z"/>
						  <circle id="successAnimationCircle" cx="35" cy="35" r="24" stroke="#979797" stroke-width="2" stroke-linecap="round" fill="transparent"/>
						  <polyline id="successAnimationCheck" stroke="#979797" stroke-width="2" points="23 34 34 43 47 27" fill="transparent"/>
						</svg>
						<?php else: ?>
							<img class="danger-icon" src="./assets/images/danger.png" alt="X">
						<?php endif; ?>

	            		<strong>Files permission check</strong>
	            		<a href="#" title="Help" class="help-link">?</a>
	            	</h3>
	            	<h3 class="item">
	            		<?php if($this->checkDirsPermission()): ?> 
	            		<svg class="animated" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 70 70" style="position: absolute;top: -3px;">
						  <path id="successAnimationResult" fill="#D8D8D8" d="M35,60 C21.1928813,60 10,48.8071187 10,35 C10,21.1928813 21.1928813,10 35,10 C48.8071187,10 60,21.1928813 60,35 C60,48.8071187 48.8071187,60 35,60 Z M23.6332378,33.2260427 L22.3667622,34.7739573 L34.1433655,44.40936 L47.776114,27.6305926 L46.223886,26.3694074 L33.8566345,41.59064 L23.6332378,33.2260427 Z"/>
						  <circle id="successAnimationCircle" cx="35" cy="35" r="24" stroke="#979797" stroke-width="2" stroke-linecap="round" fill="transparent"/>
						  <polyline id="successAnimationCheck" stroke="#979797" stroke-width="2" points="23 34 34 43 47 27" fill="transparent"/>
						</svg>
						<?php else: ?>
							<img class="danger-icon" src="./assets/images/danger.png" alt="X">
						<?php endif; ?>

	            		<strong>Dirs permission check</strong>
	            		<a href="#" title="Help" class="help-link">?</a>
	            	</h3>
					<h3 class="item">
            			<?php if($this->checkEnvKey()): ?> 
	            		<svg class="animated" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 70 70" style="position: absolute;top: -3px;">
						  <path id="successAnimationResult" fill="#D8D8D8" d="M35,60 C21.1928813,60 10,48.8071187 10,35 C10,21.1928813 21.1928813,10 35,10 C48.8071187,10 60,21.1928813 60,35 C60,48.8071187 48.8071187,60 35,60 Z M23.6332378,33.2260427 L22.3667622,34.7739573 L34.1433655,44.40936 L47.776114,27.6305926 L46.223886,26.3694074 L33.8566345,41.59064 L23.6332378,33.2260427 Z"/>
						  <circle id="successAnimationCircle" cx="35" cy="35" r="24" stroke="#979797" stroke-width="2" stroke-linecap="round" fill="transparent"/>
						  <polyline id="successAnimationCheck" stroke="#979797" stroke-width="2" points="23 34 34 43 47 27" fill="transparent"/>
						</svg>
						<?php else: ?>
							<img class="danger-icon" src="./assets/images/danger.png" alt="X">
						<?php endif; ?>
	            		<strong>Encryption key set</strong>
	            		<a href="#" title="Help" class="help-link">?</a>
	            	</h3>
            	</div>

            	<div>
            		<button onclick="location.reload();">Refresh</button>
            	</div>
            </div>
        </div>
    </body>
</html>
