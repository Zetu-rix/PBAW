{extends file="main.tpl"}

{block name=content}

<!-- Header -->
			<div id="header"></div>

				<div id="main">
					<!-- Logowanie -->
					<section id="kalkulator" class="two">
						<div class="container">
							<header>
								<h2>Logowanie do systemu</h2>
							</header>

							<form action="{$conf->action_url}login" method="post">
								<fieldset class="log-screen">
									<div>
										<label for="id_login">login: </label>
										<input id="id_login" type="text" name="login"/>
									</div>
									<div>
										<label for="id_pass">pass: </label>
										<input id="id_pass" type="password" name="pass" /><br />
									</div>
									<div>
										<input type="submit" value="zaloguj" class="pure-button pure-button-primary"/>
									</div>
								</fieldset>
								<div class="messages">

								{include file='messages.tpl'}

								{if isset($res->result)}
									<h4>Miesięczna Rata:</h4>
									<p class="res">
									{$res->result} PLN
									</p>
								{/if}
								</div>
							</form>
						</div>
				</div>
			</div>
				</section>

				
			



{/block}