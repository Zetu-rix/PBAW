{extends file="main.tpl"}

{block name=content}

<header>
    <h2>Kalkulator Kredytowy</h2>
</header>

<form action="{$action_url}calcCompute" >
    <div class="row">
        <div class="col-4 col-12-mobile">Kwota<br>
            <input type="text" name="kwota" placeholder="10000 PLN" value="{$form->kwota|default:''}">
        </div>
        <div class="col-4 col-12-mobile">Lata<br>
            <input type="text" name="lata" placeholder="5 lat" value="{$form->lata|default:''}">
        </div>
        <div class="col-4 col-12-mobile">Oprocentowanie<br>
            <input type="text" name="proc" placeholder="5 = 5%" value="{$form->proc|default:''}">
        </div>
        <div class="col-12">
            <input type="submit" value="Oblicz" />
        </div>
    </div>
</form>

<div>
    {if $msgs->isError()}
        <h4>Wystąpiły błędy:</h4>
        <ol class="err">
            {foreach from=$msgs->getErrors() item=msg}
                <li>{$msg}</li>
            {/foreach}
        </ol>
    {/if}

    {if $msgs->isInfo()}
        <h4>Informacje:</h4>
        <ol class="inf">
            {foreach from=$msgs->getInfos() item=msg}
                <li>{$msg}</li>
            {/foreach}
        </ol>
    {/if}

    {if isset($res->result)}
        <h4>Miesięczna rata:</h4>
        <p class="res">{$res->result} PLN</p>
    {/if}
</div>

{/block}
