<?php

// no direct access
defined('_JEXEC') or die('Restricted access');



$style = "
div.yacc table { 
	border-collapse: collapse;
	}
div.yacc table, div.yacc  td, div.yacc  th {
    border: 1px solid #BBBBBB;
    padding: 4px;
}
.yacc dl.tabs {
	float: left;
	margin: 10px 0 -1px 0;
	
	z-index: 50;
}

.yacc dl.tabs dt {
	float: left;
	padding: 4px 10px;
	border: 1px solid #ccc;
	margin-left: 3px;
	background: #e9e9e9;
	color: #666;
}

.yacc dl.tabs dt.open {
	background: #F9F9F9;
	border-bottom: 1px solid #f9f9f9;
	z-index: 100;
	color: #000;
}

.yacc div.current {
	clear: both;
	border: 1px solid #ccc;
	padding: 10px 10px;
}

.yacc div.current dd {
	padding: 0;
	margin: 0;
}
.yacc dl.tabs h3{
	font-size:1.0em;
}
.yacc  dl#content-pane.tabs {
	margin: 1px 0 0 0;
}
";
$document = JFactory::getDocument();
$document->addStyleDeclaration($style);

?>
<div  style="font-size:1.1em" class="nav-tabs yacc col <?php if(version_compare(JVERSION,'3.0','lt')): ?>width-50  <?php endif;?>span8  fltlft">

<?php echo JHtml::_('tabs.start','howto-1');?> 
<?php echo JHtml::_('tabs.panel', 'Intro','howto-1-intro'); ?>

<h2>Jacc é...</h2>
<p><strong>S</strong>ó <strong>o</strong>utro <strong>c</strong>riador de <strong>c</strong>omponentes</p>
<h2>Aproximação</h2>
<p> Antes que a primeira linha de código seja escrita, um modelo de dados deve ser desenvolvido. Normalmente, este modelo será posteriormente representada na base de dados. </ p>
<p> Por exemplo, eu uso o MySQL Workbench para o desenvolvimento do modelo de dados. A ferramenta é capaz de exportar tabelas diretamente em um banco de dados. </p>
<p><strong>Jacc</strong> usa essas tabelas e espere que cada tabela (na medida em que existe uma chave primária) representa o trio Model View Control.</p>
<p>
	Portanto, antes de usar <strong>Jacc</strong>, certifique-se de que existem tabelas no banco de dados do Joomla, o que corresponde ao seu modelo de dados.
	Para um pequeno teste, você pode tentar o <a class='modal' href="<?php echo JRoute::_('index.php?option=com_jacc&view=sql&tmpl=component') ?>"  rel="{handler: 'iframe', size: {x: 650, y: 475}}">script sql para um exemplo de livraria</a>.
</p>
<h2>Início Rápido</h2>
	<ol>
		<li>Importar suas tabelas no banco de dados Joomla</li>
		<li>Vá para o <strong>Jacc-&gt;Componentes</strong> e edite as <strong>Preferências</strong>.</li>
		<li>Clique em <strong>Novo</strong>. O Jacc Editor de Componente será exibido.</li>
		<li>Digite o título e a versão, selecionar as tabelas e clique <strong>Salvar</strong>. O componente aparece agora na lista de componentes</li>
		<li>Copie o link na coluna <strong>Download</strong>, cole no campo URL de instalação do <strong>Gerenciador de Instalação do Joomla</strong> e instale o componente.</li>
	</ol>
<p>
	Se você tiver respeitado as regras de nomeação sugeridos para as colunas da tabela, você terá um trabalho rudimentar, mas, o backend da administração e frontend para o componente. Você pode começar agora o desenvolvimento.
</p>		
<p>
	<i><strong>Advertência: </strong> Se você quiser repetir o procedimento, use <strong> JACC </strong> para recriar o componente antes de reinstalar ou faça cópias de segurança da estrutura das tabelas antes da desinstalação do componente.</i>
</p>
<?php echo JHtml::_('tabs.panel', 'Orientações','howto-1-guidlines'); ?>		

<h2>Orientações e Recomendações </h2>

<h3>Nomenclatura da Tabela</h3>
<p>Use o sublinhado para indicar a relação entre suas tabelas. M.e. se você estiver desenvolvendo um componente para uma livraria:</p>
<p><strong>jos_book</strong> (para a visualização principal / os livros), <strong>jos_book_author</strong>,  <strong>jos_book_publisher</strong> etc..</p>
<h3>Table Fields</h3>
<strong>Jacc</strong> reconhece alguns campos que são padrão para as tabelas do Joomla:
<ul>
	<li><strong>title</strong> (varchar) <br /> ou<br /><strong>name</strong> (varchar)</li>
	<li><strong>alias</strong> (varchar)</li>
	<li><strong>description</strong> (text)</li>
	<li><strong>catid</strong> Category (int)<br /> ou<br /><strong>category_id</strong> (int)</li>	
</ul> 
<p>
	Se você usar esses padrões, <strong>Jacc</strong> de maneira simples, criará os elementos certos para as formas e as listas de back-end.	   
</p>
<p>A lista completa de nomes de campos especiais e os resultados encontra-se no separador <strong>Otimize suas tabelas.</strong></p>
<p>
	Recomendação: Chame suas chaves primárias<strong>id</strong>
</p>
<h3>Chaves Estrangeiras</h3>
<p><strong>Jacc</strong> reconhecerá as chaves estrangeiras em suas tabelas, se você respeitar a nomeação</p>
<h5>Exemplo:</h5>
<p>
	Tabelas: <i>jos_example, jos_example_some, jos_example_foo</i>
</p>
<p>	
	Chaves Estrangeiras: <i>some_id, foo_id, example_id</i>
</p> 
<p>Então, se você usar some_id em jos_example, isso vai criar um select no backend para o "Exemplo" Visão Detalhada</p>
<h3>Formulários</h3>
<p>Uma das melhorias do Joomla 1.6 são os <strong>formulários</strong> de biblioteca.  <strong>Jacc</strong>fornece os formulários para o Joomla 1.5 também. </p>
<p>
	Os formulários são definidos por um arquivo XML em models/forms. Dê uma olhada no joomla/form/fields em sua pasta componente para ter uma idéia dos tipos de campos disponíveis.
	Para mais informações visite <a href="http://docs.joomla.org/Developers">docs.joomla.org/Developers</a>
</p>
<h2>Categorias</h2>
<p>Se você definir a opção <strong><?php echo JText::_('PARAMS_CATEGORIES_LABEL')?></strong> você irá adicionar o estilo do Joomla 1.6, com categorias aninhadas para seu componente.</p>
<h2>Restrições</h2>
<ul>
<li>Uma visão frontend apenas irá imprimir o conteúdo dos campos da tabela. Você pode imaginar que não há nenhuma maneira para <strong> JACC </strong> para acertar o propósito de seu componente.</li>
<li>Não haverá SQL-junta nos modelos frontend para as categorias ou chaves estrangeiras. Faça isso por si mesmo.</li>
<li><strong>Jacc</strong> não funcionará, se você usar um prefixo de tabela que não termine com underline.</li>
</ul>
<?php echo JHtml::_('tabs.panel', 'Desenvolvimento','howto-1-developing'); ?>

<p>Para o desenvolvimento com JACC é sugerida a seguinte abordagem:</p>


	<ol>
	<li>Instalação do <strong>Jacc</strong> em um Joomla que você usa para o desenvolvimento de componentes.</li>
		<li>Criar um modelo de dados e implementar as tabelas do MySQL.</li>

		<li>Em seguida, importe as tabelas no Joomla em que você instalou <strong>Jacc</strong>.</li>
		<li>Criar o componente e instalá-lo no mesmo Joomla.</li>
		<li>Determinar o <strong>Máximo</strong> para relatórios de erros Joomlas e depois do teste, se o armazenamento de itens funciona no backend.</li>
		<li>Se este não for o caso, verifique a nomeação de seus campos de tabela (erros comuns são a de incremento automático esquecido ou a falta de uma ID primária).</li>

		<li>Uma vez que a sua estrutura de tabela é satisfatória, você pode gerar e instalar o componente novamente (a desinstalação anterior não é necessário)</li>
		<li>No Editor de Componentes JACC ativar o "componente live" para criar pacotes de instalação do componente instalado. (Note que arquivos já existentes no componente não são substituídos, as mudanças nas tabelas em si, portanto, não têm nenhum efeito).</li>
	</ol>


	<p>Agora você pode desenvolver o componente "on site" e usar <strong>Jacc</strong> para criar arquivos de instalação.</p>
<?php echo JHtml::_('tabs.panel', 'Otimize suas Tabelas','howto-1-tables'); ?>
	
<p>Você pode tirar o máximo proveito das capacidades do YACC, se você seguir algumas regras no que diz respeito à nomeação de seus campos de tabelas:</p>


	<table class="yacctable">
		<tr>

			<td><strong>Nome do Campo</strong></td>
			<td>     <strong>Alternativas</strong>     </td>
			<td><strong>Tipo de Campo</strong>     </td>
			<td><strong>Comentários</strong></td>
		</tr>

		<tr>
			<td><strong><em>id</em></strong> </td>
			<td>Sempre Chave Primária</td>
			<td>    Campo Oculto     </td>
			<td>Este campo deve ser primário e de incremento automático. Qualquer outro nome para Chave Primária será aceito também, mas "id" é recomendado para melhor conformidade.</td>
		</tr>

		<tr>
			<td><strong><em>title</em></strong> </td>
			<td>    name, sku </td>
			<td>    Campo de Texto </td>
			<td>Em 99% há algo como um nome ou um título para um item, como um identificador humano. Se você não usar essa nomenclatura para ele, ele será recomendado a colocar um campo varchar após o campo primário (id).</td>

		</tr>
		<tr>
			<td><strong><em>alias</em></strong> </td>
			<td>    None </td>
			<td>    Campo de Texto </td>
			<td>    Este campo é necessário para produzir SEF-URLs para itens.</td>

		</tr>
		<tr>
			<td><strong><em>params</em></strong> </td>
			<td>    None </td>
			<td>    None </td>
			<td>    Permitirá que você use params. É facilmente implementada adicionando campos do formulário xml com o grupo de campos de params.</td>

		</tr>
		<tr>
			<td><strong><em>ordering</em></strong> </td>
			<td>    None </td>
			<td>    Sistema </td>
			<td>    Se você usar isso, não será mostrada uma coluna de ordenação na exibição de lista backend e vai ser usado para a classificação padrão no frontend.</td>

		</tr>
		<tr>
			<td><strong><em>published</em></strong> </td>
			<td>    state </td>
			<td>    Seletor de Publicação </td>
			<td>    O uso deste nome é altamente recomendado.</td>

		</tr>
		<tr>
			<td><strong><em>access</em></strong> </td>
			<td>    None </td>
			<td>    Seletor de Nível de Acesso </td>
		</tr>

		<tr>
			<td><strong><em>category_id</em></strong> </td>
			<td>    catid     </td>
			<td>Seletor de Categoria </td>
			<td>    Você tem que ativar "Usar Categorias" para fazer o funcionamento</td>

		</tr>
		<tr>
			<td><strong><em>parent_id</em></strong> </td>
			<td>    parentid </td>
			<td>    Seletor </td>
			<td>    Construir uma árvore. Você pode conectar um item para um pai de backend, mas você tem que implementá-lo no frontend por si mesmo.</td>

		</tr>
		<tr>
			<td><strong><em>description</em></strong> </td>
			<td>    Texto </td>
			<td>    Editor </td>
			<td> Cada campo de tipo texto resultará num campo também editor. A nomeação recomendada fará com que o editor aparecer no lugar de costume na forma backend.</td>

		</tr>
		<tr>
			<td><strong><em>language</em></strong> </td>
			<td>    None </td>
			<td>    Seletor de Linguagem </td>
			<td> </td>

		</tr>
		<tr>
			<td><strong><em>created</em></strong> </td>
			<td>    created_time </td>
			<td>    Calendário </td>
			<td>     Se este campo não for preenchido,a data de hoje será salva automaticamente.</td>

		</tr>
		<tr>
			<td><strong><em>created_by</em></strong> </td>
			<td>    None </td>
			<td>    Texto Impresso </td>
			<td>     O nome do Autor</td>

		</tr>
		<tr>
			<td><strong><em>created_by_alias</em></strong> </td>
			<td>     None </td>
			<td>    Texto Impresso </td>
			<td>    FAZER: Tornar mais num campo de texto</td>

		</tr>
		<tr>
			<td><strong><em>modified</em></strong> </td>
			<td>    None </td>
			<td>    Texto Impresso </td>
			<td>    Para ser salvo automaticamente.</td>

		</tr>
		<tr>
			<td><strong><em>modified_by</em></strong> </td>
			<td>    None </td>
			<td>    Texto Impresso </td>
			<td>    Para ser salvo automaticamente.</td>

		</tr>
		<tr>
			<td><strong><em>checked_out</em></strong> </td>
			<td>    checked_out_time </td>
			<td>    Sistema </td>
			<td> Para ser salvo automaticamente.</td>

		</tr>
		<tr>
			<td><strong><em>checked_out_by</em></strong> </td>
			<td>    None </td>
			<td>    Sistema </td>
			<td>    Para ser salvo automaticamente.</td>

		</tr>
		<tr>
			<td><strong><em>publish_up</em></strong> </td>
			<td>    None </td>
			<td>    Calendário </td>
			<td>    Ainda não implementado no frontend.</td>

		</tr>
		<tr>
			<td><strong><em>publish_down</em></strong> </td>
			<td>    None </td>
			<td>    Calendário </td>
			<td>    Ainda não implementado no frontend.</td>

		</tr>
		<tr>
			<td><strong><em>image</em></strong> </td>
			<td>    None </td>
			<td>    Imageup </td>
			<td>    Fornece o carregamento de imagens e criação automática de miniaturas.</td>

		</tr>		
	</table>
<?php echo JHtml::_('tabs.panel', 'Compatibilidade','howto-1-compat'); ?>

<p>O Componente de Exemplo foi testado com Joomla 2.5, 3.1</p>
<h2>Jacc Desenvolvimento</h2>
<p>Se você quiser fazer <strong>Jacc</strong> combinando mais o seu estilo de programação, você pode personalizar cuidadosamente os arquivos em <strong>com_jacc/templates</strong>. </p>
<p>Modelos na pasta <strong>mvcbase</strong> são classes comuns, que não necessitam de uma série de mudanças, aqueles na pasta <strong>mvctriple</strong> serão especializadas para o componente e seu modelo de dados. 
	   Há uma série de espaços reservados, mas você vai entender o que eles fazem.

<?php echo JHtml::_('tabs.panel', 'SubVersão','howto-1-subversion'); ?>

<p>O seguinte procedimento foi aplicado com sucesso pelo autor:</p>


	<h3 id="Prerequisite">Pré-Requisito:</h3>


	<p>O sistema de desenvolvimento (Joomla) está sob controle de versão.</p>


	<h3 id="Procedure">Procedimento:</h3>


	<ol>
	<li>Criando e Instalando um Componente.</li>
		<li>Descompacte o pacote de instalação em uma pasta e coloque-o via importação svn no raiz do repositório.</li>
		<li>A partir do Joomla exclua frontend e backend do componente .</li>

		<li>No diretório administrator/components registar na raiz /admin como externo: <br>  <pre>svn propset svn:externals com_mycomponent http://svn.mydomain.tld/repository/trunk/admin components</pre></li>
		<li>No diretório de componentes registar na raiz /site como externa</li>
	</ol>


	<p>Cada commit irá agora atualizar o repositório de componentes</p>

<?php echo JHtml::_('tabs.end');?>
</div>
<div class="col <?php if(version_compare(JVERSION,'3.0','lt')): ?>width-40  <?php endif;?>span2 fltrt">
<fieldset class="adminform">
	<legend>About</legend>
	<strong>Author:</strong> Michael Liebler<br />
	<strong>Home:</strong> <a href="http://www.janguo.de">www.janguo.de</a><br />
	<strong>License:</strong> <a href="http://www.gnu.org/licenses/gpl-2.0.html">http://www.gnu.org/licenses/gpl-2.0.html</a>  GNU/GPL<br />		
	<strong>Forum/Feature Request</strong>: <a href="http://redmine.janguo.de/projects/jacc/">redmine.janguo.de/projects/jacc/</a> (registration required)	
</fieldset>
<fieldset class="adminform">
	<legend>Support other users</legend>
	<p>Support other users by sharing your experiences with <strong>Jacc</strong> on <a href="http://extensions.joomla.org/extensions/miscellaneous/development/13644">extensions.joomla.org</a>.
</fieldset>
<fieldset class="adminform">
	<legend>Make a Donation</legend>
					<table>
	<tr>	
		<td align="center">
			If <strong>Jacc</strong> was usefull for you, please make a little donation, to bring the developement forward. Thank you.</td>
	</tr>
	<tr>
		<td align="center">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
			<input type="hidden" name="cmd" value="_donations">

			<input type="hidden" name="business" value="michael-liebler@janguo.de">
			<input type="hidden" name="item_name" value="">
			<input type="hidden" name="amount" value="">
			<input type="hidden" name="no_shipping" value="1">
			<input type="hidden" name="currency_code" value="EUR">
			<input type="hidden" name="tax" value="0">
			<input type="hidden" name="lc" value="DE">
			<input type="hidden" name="bn" value="PP-DonationsBF">
			<input type="image" src="http://wzcreativetechnology.com/paypal/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">

			<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>	
		</td>
	</tr>
</table>
</fieldset>

</div>
<form method="post" action="index.php?option=com_jacc" id="adminForm" name="adminForm">
		<input type="hidden" name="option" value="com_jacc" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="view" value="jacc" />	
		<?php echo JHTML::_( 'form.token' ); ?>
</form>
<div class="clr"></div>
<div style="text-align:center;font-weight:bold;padding:10px;clear:both">Jacc Version <?php print JaccHelper::getVersion() ?></div> 
