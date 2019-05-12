<?php
public function fetch()
{
$this->load->model('M_notification');
if($this->input->post("view") != '')
{
$data=array('status_notification'=>"1");
$query=$this->M_notification->update($data,$this->session->userdata('nopeg'));
}
$query=$this->M_notification->select($this->session->userdata('nopeg'));
$output = '';
$date = '';
$status = '';
if($this->db->affected_rows() > 0)
{
foreach ($query as $key) {
if($key['status_notification']==0)
{
$output .= '
<li>
<a href="#">
<strong>'.$key["date"].'</strong><br />
<small><em>'.$key["status"].'</em></small>
</a>
</li>
';
$date = $key['date'];
$status = $key['status'];
}
}
}
else{
$output .= '
<li><a href="#" class="text-bold text-italic">No Notif Found</a></li>';	
}
$count = $this->db->affected_rows();
$data = array(
'notification' => $output,
'unseen_notification'  => $count,
'date' => $date,
'status' =>$status
);
echo json_encode($data);
}
?>