<?IncludeTemplateLangFile(__FILE__);?>	

    
 </div>
            <footer>
			<hr>
                 <?if(COption::GetOptionString("simai.special", "address", "")!=""):?> <h5><strong><?=GetMessage('SITE_ADDRESS')?>: </strong><?=COption::GetOptionString("simai.special", "address", "")?></h5><?endif;?>
				 <?if(COption::GetOptionString("simai.special", "phone", "")!=""):?><h5><strong><?=GetMessage('SITE_PHONE')?>: </strong><?=COption::GetOptionString("simai.special", "phone", "")?></h5><?endif;?>
				 <?if(COption::GetOptionString("simai.special", "email", "")!=""):?><h5><strong><?=GetMessage('SITE_EMAIL')?>: </strong><?=COption::GetOptionString("simai.special", "email", "")?></h5><?endif;?>
			<hr>
				 <h5><?=COption::GetOptionString("simai.special", "copyright", "")?></h5>
            </footer>
        </div>        

    </body>
</html>
