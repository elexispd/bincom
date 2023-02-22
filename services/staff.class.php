<?php 

class Staff {
	private $db;
	private $first_name;
	private $last_name;
	private $sg;
	private $state_of_origin;
	private $gender;
	private $username;
	private $date_of_enlistment;
	private $date_last_promoted;
	private $qualification;
	private $role;
	private $year_of_birth;
	private $msg = [];

	function __construct($db) {
		$this->db = $db;
	}

	public function set_staff($fname, $lname,$username,$state, $role,$gender,$qualification, $year, $sg, $enlist,$promote) {
		
		$this->first_name = $fname;
		$this->last_name = $lname;
		$this->username = $username;
		$this->state_of_origin = $state;
		$this->role = $role;
		$this->gender = $gender;
		$this->qualification = $qualification;
		$this->year_of_birth = $year;
		$this->date_of_enlistment = $enlist;
		$this->date_last_promoted = $promote;
		$this->sg = $sg;
		$this->file = "";
		 

		$this->set_fname();
		$this->set_lname();
		$this->set_username();
		$this->set_state();
		$this->set_role();
		$this->set_gender();
		$this->set_qualification();
		$this->set_year();
		$this->set_sg();
		$this->set_enlistment();
		$this->set_promoted();

		if(empty($this->msg)) {
			if ($this->gender == "Male") {
				$this->file = "../images/staff/male.png";
			} else if($this->gender == "Female") {
				$this->file = "../images/staff/female.png";
			}
			
					$password = password_hash($this->year_of_birth, PASSWORD_DEFAULT);
					$id = rand(100, 999)+time();
					$sql = "INSERT INTO staff(first_name, last_name, username, state,role,lecturer_id,password, gender, qualification,year_of_birth, position, date_of_employment,date_of_promotion, photo ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
					$stmt = $this->db->run($sql, [$this->first_name, $this->last_name, $this->username, $this->state_of_origin,$this->role,$id,$password, $this->gender,$this->qualification,$this->year_of_birth,$this->sg, $this->date_of_enlistment, $this->date_last_promoted, $this->file]);
					if ($stmt->rowCount() > 0) {
						$this->message(1, "Registration successful");
					} else {
						$this->message(0, "Data not inserted");
					  }
		}

		return json_encode($this->msg);
	}

	public function set_fname() {
		$this->first_name = htmlspecialchars(trim($this->first_name));
		$this->first_name = ucfirst($this->first_name);
		if (empty($this->first_name)) {
			$this->message(0, "First name is empty");
		}
		else if (!preg_match("/^[a-zA-Z]*$/", $this->first_name)) {
			$this->message(0, "First name should have only letters");
		}
	}
	private function set_lname() {
		$this->last_name = htmlspecialchars(trim($this->last_name));
		$this->last_name = ucfirst($this->last_name);
		if (empty($this->last_name)) {
			$this->message(0, "last name is empty");
		}
		else if (!preg_match("/^[a-zA-Z]*$/", $this->last_name)) {
			$this->message(0, "Last name should have only letters");
		}
	}
	private function set_username() {
		$this->username = htmlspecialchars(trim($this->username));
		$this->username = strtolower($this->username);
		if (empty($this->username)) {
			$this->message(0, "username is empty");
		}
		else if (!preg_match("/^[a-zA-Z0-9_]*$/", $this->username)) {
			$this->message(0, "username cna only contain letters,underscore and numbers");
		} else{
			$sql = "SELECT * FROM staff WHERE username = ?";
			$stmt = $this->db->run($sql, [$this->username]);
			if ($stmt->rowCount() > 0) {
				$this->message(0, "username already exist");
			}
		}
	}
	public function set_promoted() {
		if (empty($this->date_last_promoted)) {
			$this->message(0, "Date of promotion is empty");
		}

	}
	public function set_enlistment() {
		if (empty($this->date_of_enlistment)) {
			$this->message(0, "Date of enlistment is empty");
		}
	}
	public function set_state() {
		$this->state_of_origin = htmlspecialchars(trim($this->state_of_origin));
		$this->state_of_origin = ucfirst($this->state_of_origin);
		if (empty($this->state_of_origin)) {
			$this->message(0, "State of origin is empty");
		}
		else if (!preg_match("/^[a-zA-Z ]*$/", $this->state_of_origin)) {
			$this->message(0, "State should have only letters");
		}
	}
	public function set_qualification() {
		$this->qualification = htmlspecialchars(trim($this->qualification));
		$this->qualification = ucfirst($this->qualification);
		if (empty($this->qualification)) {
			$this->message(0, "qualification is empty");
		}
		elseif (!preg_match("/^[a-zA-Z ]*$/", $this->qualification)) {
			$this->message(0, "qualification should have only letters");
		}
	}
	public function set_gender() {
		$this->gender = htmlspecialchars(trim($this->gender));
		$this->gender = ucfirst($this->gender);
		if (empty($this->gender)) {
			$this->message(0, "Gender is empty");
		}
		elseif (!preg_match("/^[a-zA-Z]*$/", $this->gender)) {
			$this->message(0, "gender should have only letters");
		} 
	}
	public function set_role() {
		$this->role = htmlspecialchars(trim($this->role));
		$this->role = ucfirst($this->role);
		if (empty($this->role)) {
			$this->message(0, "role is empty");
		}
		elseif (!preg_match("/^[a-zA-Z ]*$/", $this->role)) {
			$this->message(0, "role should have only letters");
		}
	}
	private function set_sg() {
		$this->sg = htmlspecialchars(trim($this->sg));
		$this->sg = ucfirst($this->sg);
		if (empty($this->sg)) {
			$this->message(0, "position is empty");
		}
		else if (!preg_match("/^[a-zA-Z]*$/", $this->sg)) {
			$this->message(0, "position should have only letters");
		}
	}
	public function set_year() {
		$this->year_of_birth = htmlspecialchars(trim($this->year_of_birth));
		$this->year_of_birth = ucfirst($this->year_of_birth);
		if (empty($this->year_of_birth)) {
			$this->message(0, "Year of birth is empty");
		}
		elseif (!preg_match("/^[0-9]*$/", $this->year_of_birth)) {
			$this->message(0, "Invalid year");
		}
	}

	public function update_staff($fname, $lname,$state, $role,$gender,$qualification, $year, $sg, $enlist,$promote, $username) {
		
		$this->first_name = $fname;
		$this->last_name = $lname;
		$this->state_of_origin = $state;
		$this->role = $role;
		$this->gender = $gender;
		$this->username = $username;
		$this->qualification = $qualification;
		$this->year_of_birth = $year;
		$this->date_of_enlistment = $enlist;
		$this->date_last_promoted = $promote;
		$this->sg = $sg;
		$this->file = "";
		 

		$this->set_fname();
		$this->set_lname();
		$this->set_state();
		$this->set_role();
		$this->set_gender();
		$this->set_qualification();
		$this->set_year();
		$this->set_sg();
		$this->set_enlistment();
		$this->set_promoted();

		if(empty($this->msg)) {
			if ($this->gender == "Male") {
				$this->file = "../images/staff/male.png";
			} else if($this->gender == "Female") {
				$this->file = "../images/staff/female.png";
			}
			$sql = "UPDATE staff SET first_name = ?, last_name= ?, state= ?,role= ?, gender= ?, qualification= ?,year_of_birth=  ?, position=  ?, date_of_employment=  ?,date_of_promotion=  ?, photo=  ? WHERE username = ?";
			$stmt = $this->db->run($sql, [$this->first_name, $this->last_name, $this->state_of_origin,$this->role, $this->gender,$this->qualification,$this->year_of_birth,$this->sg, $this->date_of_enlistment, $this->date_last_promoted, $this->file, $this->username]);
			if ($stmt->rowCount() > 0) {
				$this->message(1, "Update successful");
			} else {
				$this->message(0, "No changes made");
			  }
		}

		return json_encode($this->msg);
	}

	public function get_staff() {
		// $id = htmlspecialchars($id);
		$sql = "SELECT * FROM staff";
		$stmt = $this->db->run($sql);
		if ($stmt->rowCount() > 0) {
			$result = $stmt->fetchAll();
			return $result;
		}
	}

	public function get_staff_profile($username) {
		$username = htmlspecialchars($username);
		$sql = "SELECT * FROM staff WHERE username = ?";
		$stmt = $this->db->run($sql, [$username]);
		if ($stmt->rowCount() > 0) {
			$result = $stmt->fetchAll();
			return $result;
		}
	}

	public function total_staff() {
		$sql = "SELECT * FROM staff";
		$stmt = $this->db->run($sql);
		return $stmt->rowCount();
	}

	public function message($key, $value){
        $this->msg["status"] = $key;
		$this->msg["message"] = $value;
	}

	public function profile($key,$value) {
		if ($key == "lecturer") {
			$sql = "SELECT * FROM staff WHERE username = ?";
			$stmt = $this->db->run($sql, [$value]);
			if ($stmt->rowCount() > 0) {
				$result = $stmt->fetchAll();
				return $result;
			}
		} else {
			$sql = "SELECT * FROM staff WHERE role = ?";
			$stmt = $this->db->run($sql, [$key]);
			if ($stmt->rowCount() > 0) {
				$result = $stmt->fetchAll();
				return $result;
			}
		}	
	}

	public function change_pass($pass, $cpass, $user) {
		if (empty($pass) || empty($cpass)) {
			$this->message(0, "All fields must be filled");
		} else if($pass != $cpass) {	
			$this->message(0, "Passwords don't match");
		} else {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			$sql = "UPDATE staff SET password = ? WHERE username = ?";
			$stmt = $this->db->run($sql, [$password, $user]);
			if ($stmt->rowCount() > 0) {
				$this->message(1, "Password has been changed successfully");
			} else {
				$this->message(0, "Something went wrong. Try again");
			}
		}

		return json_encode($this->msg);
	}

	
	/*-------------------------------------------THIS SEECTION IS FOR SETTING, GETTING EXAM FOR STAFF-------------------------------------------*/

	public function set_exam($c_id, $lec_id, $question, $opt1, $opt2, $opt3, $opt4, $ans, $c_no, $course_name, $category) {
		$c_id = htmlspecialchars($c_id);
		$lec_id = htmlspecialchars($lec_id);
		$question = htmlspecialchars($question);
		$opt1 = htmlspecialchars($opt1);
		$opt2 = htmlspecialchars($opt2);
		$opt3 = htmlspecialchars($opt3);
		$opt4 = htmlspecialchars($opt4);
		$ans = htmlspecialchars($ans);
		$c_no = htmlspecialchars($c_no);
		$category = htmlspecialchars($category);
		if ($category == 'practice') {
			$duration = 300;
		} else {
			$duration = '';
		}
		

		if (empty($question) || empty($opt1) || empty($opt2) || empty($opt3) || empty($opt4) || empty($ans) || empty($c_no) || empty($category)) {
			$this->message(0, "All fields are required");
		} else {
			$name = strtolower(trim($course_name));
			$sql = "SHOW TABLES LIKE '%".$name."%'";
			$stmt = $this->db->run($sql);
			$result = $stmt->fetchAll(PDO::FETCH_NUM);

			$year = date("Y");
			// $q_id = rand(1000,9999).rand(1000,9999);
			$q_id = time()+rand(1000,9999);
			foreach ($result as  $value) {
				$table =  $value[0];
				$sqll = "INSERT INTO $table (course_id,lecturer_id, question,question_id,option_a,option_b,option_c,option_d,answer,year,course_no,duration,category) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$stmtt = $this->db->run($sqll, [$c_id,$lec_id,$question,$q_id,$opt1, $opt2, $opt3, $opt4, $ans,$year, $c_no,$duration, $category]);
				if ($stmtt->rowCount() > 0) {
					$this->message(1, "Question added");
				} else {
					$this->message(0, "Something went wrong");
				}
				
			}
			
		}

		return json_encode($this->msg);

	}

	public function get_table($name) {
		$name = strtolower(trim($name));
			$sql = "SHOW TABLES LIKE '%".$name."%'";
			$stmt = $this->db->run($sql);
			$result = $stmt->fetchAll(PDO::FETCH_NUM);
			$b = "";
			foreach ($result as $value) {
				$b =$value[0];
			}

			return $b;
	}

	public function get_question_no($name) {
				$result = $this->get_table($name);
				$sqll = "SELECT * FROM $result";
				$stmtt = $this->db->run($sqll);
				$count = $stmtt->rowCount();
				return $count+1;
		
	}

	public function get_course_questions($name, $id) {
		$table = $this->get_table($name);
		$sql = "SELECT * FROM $table WHERE lecturer_id = ? AND status = 0";
		$stmt = $this->db->run($sql, [$id]);
		return $stmt->fetchAll();
	}

	public function get_course_questions_cord($name, $id) {
		$table = $this->get_table($name);
		$sql = "SELECT * FROM $table WHERE course_id = ?";
		$stmt = $this->db->run($sql, [$id]);
		return $stmt->fetchAll();
	}

	public function get_q_edit($name, $id) {
		$table = $this->get_table($name);
		$sql = "SELECT * FROM $table WHERE question_id = ?";
		$stmt = $this->db->run($sql, [$id]);
		return $stmt->fetchAll();
	}


	public function edit_question($q, $o1,$o2,$o3,$o4,$ans,$name,$c_no, $cat, $id) {
		$table = $this->get_table($name);
		$q = trim($q);
		$o1 = trim($o1);
		$o2 = trim($o2);
		$o3 = trim($o3);
		$o4 = trim($o4);
		if (empty($q)|| empty($o1)|| empty($o2)|| empty($o3)|| empty($o4)|| empty($ans)) {
			return "All fields are required";
		} else {
			$sql = "UPDATE $table SET question = ?,  option_a = ?,  option_b = ?, option_c = ?, option_d = ?,answer = ? , course_no = ?, category = ?WHERE question_id = ?";
			$stmt = $this->db->run($sql, [$q,$o1,$o2,$o3,$o4,$ans, $c_no, $cat, $id]);
			if($stmt->rowCount() > 0) {
				$this->message(1,"Question has been updated");
			} else {
				$this->message(0,"No changes made");
			}
		}
		return json_encode($this->msg);
	}



	public function set_approval($db,$duration, $date, $co_no, $co_id, $cat) {
		$table = $this->get_table($db);
		$year = date("Y");
		$cur = strtotime(date("Y-m-d"));
	   	$d =  strtotime($date);
	   	$a = $d - $cur;
		if (empty($date)) {
			$this->message(0, "Exam date not selected");
		} else if(empty($duration)) {
			$this->message(0, "Exam duration not selected");
		} else if($a < 0) {
			$this->message(0, "Exam date should be in the future");
		}
		else {
			$sql = "UPDATE $table SET status = ?, duration = ?, exam_date = ? WHERE year = ? AND course_no = ? AND course_id = ? AND category = ?";
			$stmt = $this->db->run($sql, [1, $duration, $date, $year, $co_no, $co_id, $cat]);
			if ($stmt ->rowCount() > 0) {
				$this->message(1, "Questions for this course have been approved");
			} else {
				$this->message(0, "Approval failed!");
			}
		}
		return json_encode($this->msg);
	}

	// checks whether a question is a duplicate
	public function is_duplicate($tbl, $q_id,  $yr, $cat, $co_no) {
		$table = $this->get_table($tbl);
		$sql = "SELECT * FROM $table WHERE question_id = ? AND year = ? AND category = ? AND course_no = ?";
		$stmt = $this->db->run($sql, [$q_id,  $yr, $cat, $co_no]);
		if ($stmt->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}
	

	// for the cordinator


	public function get_results($cat) {
		$cat = $cat."_score";
		$sql = "
				SELECT
				     s.first_name
				    , s.last_name
				    ,MAX(IF(c.course_id = 963976, r.$cat, 0)) as `database`
				    ,MAX(IF(c.course_id = 894259, r.$cat, 0)) as `excel`
				    ,MAX(IF(c.course_id = 758481, r.$cat, 0)) as `ca`
				    ,MAX(IF(c.course_id = 490032, r.$cat, 0)) as `english`
				    ,MAX(IF(c.course_id = 514118, r.$cat, 0)) as `powerpoint`
				    ,MAX(IF(c.course_id = 297435, r.$cat, 0)) as `typing`
				    ,MAX(IF(c.course_id = 185162, r.$cat, 0)) as `word`
				    ,MAX(IF(c.course_id = 226931, r.$cat, 0)) as `internet`
				    ,MAX(IF(c.course_id = 159167, r.$cat, 0)) as `security`
				    -- , SUM(r.$cat) as 'total'
				FROM result r
				LEFT JOIN courses AS c ON r.course_id = c.course_id
				LEFT JOIN students AS s ON s.ap_number = r.student_id
				WHERE s.status = 1
				GROUP BY s.ap_number";
		$stmt = $this->db->run($sql);
		return $stmt->fetchAll();
	}

	
	//for each lecturer

	public function get_course_result($course_id, $cat) {
		$cat = $cat."_score";
		$sql = "SELECT
				   s.first_name, s.last_name,
				   MAX(r.$cat) AS $cat,
			       c.course_title
			       FROM students AS s
			       JOIN result AS r
			       ON s.ap_number = r.student_id
			       JOIN courses AS c
			       ON c.course_id = r.course_id
			       WHERE c.course_id = ? GROUP BY s.ap_number";
		// $sql = "SELECT
		// 		   s.first_name, s.last_name,
		// 		   r.$cat,
		// 	       c.course_title
		// 	       FROM students AS s
		// 	       JOIN result AS r
		// 	       ON s.ap_number = r.student_id
		// 	       JOIN courses AS c
		// 	       ON c.course_id = r.course_id
		// 	       WHERE c.course_id = ? GROUP BY s.ap_number, r.$cat ORDER BY r.$cat DESC";
		$stmt = $this->db->run($sql, [$course_id]);
		return $stmt->fetchAll();
	}

	//lecturer to delete question
	public function delete_question($name, $q_id) {
		$table = $this->get_table($name);
		$sql = "DELETE FROM $table WHERE question_id = ?";
		$stmt = $this->db->run($sql, [$q_id]);
		if ($stmt->rowCount() > 0) {
			return "Question has been deleted";
		} else{
			return "Something went wrong";
		}
	}




}