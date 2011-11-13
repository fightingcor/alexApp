		<div id="menu">
			<h1>Menu List</h1>			
			<ul>
				<li>
					<a href="<?=$this->url(array('controller'=>'index'), 'default', true)?>">HOME</a>				
				</li>
				<li>
					<a href="<?php 
	        			echo $this->url(array('controller'=>'guestbook'), 'default', true);
	        		?>">Guestbook</a>
	        	</li>
				<li>
					<a href="<?php 
	        			echo $this->url(array('controller'=>'album', 'action'=>'index'));
	        		?>">Album List</a>
	        	</li>
	        	<li>
					<a href="<?php 
	        			echo $this->url(array('controller'=>'countdown', 'action'=>'index'));
	        		?>">Count Down</a>
	        	</li>
			</ul>
		</div>