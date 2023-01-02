<div class="pp-row pp-center">
	<div class="pp-col card p-padding_15 ps8">
	<?php
if (isset($status)) {?>
	<div class="center"><span class="center font-bold teal-text"><?php echo $status; ?></span></div>
	<?php
}
?>
		<form action="<?php echo site_url('admin/other/faq/add'); ?>" method="post" class="pp-form">
			<div class="pp-col pp-padres pm12">
						<div class="pp-col pp-text-field ps12">
							<label>Question:</label>
							<textarea placeholder="Question" name="faq_question" required type="text" class=""></textarea>
						</div>

			</div>
			<div class="pp-col pp-padres pm12">

						<div class="pp-col pp-text-field ps12">
							<label>Answer:</label>
							<textarea placeholder="Answer" name="faq_answer" type="text" required class=""></textarea>
						</div>

			</div>
	<div class="pp-col pp-padres pm8">
						<div class="pp-col pm4  padding1"></div>
						<button class="btn waves-effect pp-col pm3 waves-light add_product_submit" type="submit" name="add_faq_admin">Add
						</button>
						<div class="pp-col pm4  padding1"></div>
					</div>
		</form>
	</div>

<ul class="collapsible popout pp-col zero_padding ps12" data-collapsible="accordion">
<?php
$a = 0;
foreach ($questions as $key => $value) {$a++;?>
<li class="question_div">
      <div class="collapsible-header grey-text text-darken-2"><span class="font-bold p-padding_lr_1rem grey-text text-darken-2"><?php echo $a . ". "; ?></span><?php echo $value->que; ?></div>
      <div class="collapsible-body grey-text text-darken-1"><p><?php echo $value->ans; ?></p>
      <div class="center"><button faq-id="<?php echo $value->id; ?>" class="p-padding_lr_1rem open_model waves-effect waves-light margin_10 btn"><i class="material-icons">mode_edit</i></button><button add-data="<?php echo $value->id; ?>" class="btn delete_question waves-effect waves-light p-padding_lr_1rem margin_10 red lighten-1" ><i class="material-icons">delete_forever</i></button></div></div>
    </li>
 <?php }?>


  </ul>
</div>

  <!-- Modal Structure -->
  <div id="edit_question" class="modal">
    <div class="modal-content">
      <h5 class="teal-text center">Edit Question</h5>
      <form action="<?php echo site_url('admin/other/faq/update_question'); ?>" method="post" id="update_question_form" class="pp-form">
      <input type="hidden" name="faq_id" class="display_none faq_id"/>
			<div class="pp-col pp-padres pm12">
						<div class="pp-col pp-text-field ps12">
							<label>Question:</label>
							<textarea placeholder="Question" name="faq_question" required type="text" class="faq_question"></textarea>
						</div>

			</div>
			<div class="pp-col pp-padres pm12">

						<div class="pp-col pp-text-field ps12">
							<label>Answer:</label>
							<textarea placeholder="Answer" name="faq_answer" type="text" required class="faq_answer"></textarea>
						</div>

			</div>
	<div class="pp-col pp-padres pm8">
						<div class="pp-col pm4  padding1"></div>
						<button class="btn waves-effect pp-col pm3 waves-light add_product_submit" type="submit" name="update_faq_admin">Update
						</button>
						<div class="pp-col pm4  padding1"></div>
					</div>
		</form>
    </div>
  </div>
<script>


function show_confire_box(object){
		swal({
  title: "Are you sure?",
  text: 'You want to delete this FAQ?',
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes",
  closeOnConfirm: false
},
function(){
delete_question(object);
});
}
function delete_question(objects){
		var questionid = $(objects).attr('add-data');
var object_div = $(objects).parents(".question_div");
		$.post(base_url+'admin/other/faq/delete_question', {que_id: questionid}, function(data, textStatus, xhr) {
			console.log(data);
			if(data.result == true){
swal.close();
				  Lobibox.notify('default', {
    msg: 'Delete Question Successfully.'
});
object_div.remove();
			}else{
				swal.close();
							  Lobibox.notify('default', {
    msg: 'Error: Reload Page..'
});

				location.reload();
			}
		},"json");
	}
	$(".delete_question").on('click', function(event) {
		event.preventDefault();
		var objects = $(this);
		show_confire_box(objects);

	});
	$(document).ready(function() {
		$(".open_model").on('click', function(event) {
			event.preventDefault();
			var que_id = $(this).attr('faq-id');
			$.post(base_url+'admin/other/faq/get_question_single', {faq_id: que_id}, function(data, textStatus, xhr) {
				console.log(data);
				$("#update_question_form .faq_id").val(data.id);
				$("#update_question_form .faq_question").val(data.que);
				$("#update_question_form .faq_answer").val(data.ans);
				$('#edit_question').openModal();
			},"json");

		});

	});

</script>