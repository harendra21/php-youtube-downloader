<div class="container">
    <div class="row">
        <div class="col-xs-12 text-center">
            <h3>YouTube Video Downloader</h3>
        </div>
        <form class="form-group" method="POST" action="<?php echo base_url(); ?>">
        	<div class="row">
        		<div class="col-xs-12 form-group">
        			<input type="url" name="video_link" id="link" class="form-control" <?php if(!empty($link)): ?> value="<?php echo e($link); ?>" <?php endif; ?>>
        		</div>
        		<div class="col-xs-12 text-center form-group">
        			<input type="submit" name="submit" class="btn btn-primary">
        		</div>
        	</div>
        </form>
    </div>
    <div class="row">
    	
    	<?php if(!empty($videos)): ?>
    	<div class="col-sm-4 text-center">
    		<iframe src="https://www.youtube.com/embed/<?php echo e($iframe_link); ?>?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    	</div>
    	<div class="col-sm-8">
    		<table class="table table-bordered">
    			<thead>
    				<tr>
    					<th>format</th>
    					<th>Download</th>
    				</tr>
    			</thead>
    			<tbody>
    				<?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    					<tr>
    						<td><?php echo e($video['format']); ?></td>
    						<td><a href="<?php echo e($video['url']); ?>" class="btn btn-success" download>Download</a></td>
    					</tr>
    				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    			</tbody>
    		</table>
    	</div>
    	<?php endif; ?>
    </div>
</div>


<script type="text/javascript">
	$('.loaderImage').hide();
	$('#data_div').hide();
	function request_download(){
		$('.loaderImage').show();
		var link = $('#link').val();
		
		$.ajax({
		        type: "POST",
		        url: "<?php echo base_url();?>download_video",
		        data: { video_link: link },
		        dataType: 'json',                         
		        success: function(json){                
		            $('#data_div').show();

		            var tr;
			        for (var i = 0; i < json.length; i++) {
			            tr = $('<tr/>');
			            tr.append("<td>" + json[i].format + "</td>");
			            tr.append("<td> <a href='" + json[i].url + "' class='btn btn-primary'>Download</td>");
			            
			            $('#bind_data').append(tr);
			        }

		            $('.loaderImage').hide();
		        },
		        error: function (response) {
		        	$('#data_div').hide();
		           $('.loaderImage').hide();
		    }           
	    });

	}
</script>