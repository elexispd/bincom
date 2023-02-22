<?php 


class Results 
{
	
	private $polling_uint;
	private $db;
	private $party;
	private $polling_unit;
	private $score;
	private $staff_name;
	private $ip_address;
	private $system_message;

	function __construct($db) {
		$this->db = $db;
	}

	public function get_lga() {
		$sql = "SELECT * FROM lga";
		$stmt = $this->db->run($sql);
		if ($stmt->rowCount() > 0) {
			$result = $stmt->fetchAll();
			return $result;
		}
	}

	public function get_polling_results(int $id) {
		$sql = "SELECT * FROM announced_pu_results WHERE polling_unit_uniqueid = ?";
		$stmt = $this->db->run($sql, [$id]);
		if ($stmt->rowCount() > 0) {
			$result = $stmt->fetchAll();
			return $result;
		}
	}

	public function get_total_lga_results($lga_id) {
		$sql = "SELECT r.party_abbreviation, r.party_score,  SUM(r.party_score) AS total_score,
					   p.polling_unit_id, p.lga_id
				FROM `announced_pu_results` AS r
				JOIN polling_unit AS p
				ON r.polling_unit_uniqueid = p.uniqueid
				WHERE p.uniqueid = ?
				GROUP BY r.party_abbreviation";
		$stmt = $this->db->run($sql, [$lga_id]);
		if ($stmt->rowCount() > 0) {
			$result = $stmt->fetchAll();
			return $result;
		} else{
			return false;
		}
	}

	public function get_party() {
		$sql = "SELECT * FROM party";
		$stmt = $this->db->run($sql);
		if ($stmt->rowCount() > 0) {
			$result = $stmt->fetchAll();
			return $result;
		}
	}

	public function set_party($party) {
		$this->party = $party;
		if (empty($this->party)) {
			$this->message("party", "Field cannot be empty");
		} elseif (!preg_match("/^[a-zA-Z ]+$/", $this->party)) {
			$this->message("party", "Only letters and space are valid");
		}
	}

	public function set_polling_unit($unit) {
		$this->polling_unit = $unit;
		if (empty($this->polling_unit)) {
			$this->message("unit", "Field must not be empty");
		} elseif (!preg_match("/^[0-9]+$/", $this->polling_unit)) {
			$this->message("unit", "Invalid number of vote");
		}
	}

	public function set_score($score) {
		$this->score = $score;
		if (empty($this->score)) {
			$this->message("score", "Field must not be empty");
		} elseif (!preg_match("/^[0-9]+$/",$this->score)) {
			$this->message("score", "Invalid number of vote");
		}
	}

	public function set_staff($staff) {
		$this->staff_name = $staff;
		if (empty($this->staff_name)) {
			$this->message("staff", "Field must not be empty");
		} elseif (!preg_match('/^[a-zA-Z ]+$/', $this->staff_name)) {
			$this->message("staff", "Only letters and space are required");
		}
	}

	public function set_ip($ip) {
		$this->ip_address = $ip;
		if (empty($this->ip_address)) {
			$this->message("ip", "Field must not be empty");
		} elseif (!preg_match("/^[0-9.:]*$/", $this->ip_address)) {
			$this->message("ip", "Invalid ip");
		}
	}

	public function store($unit, $party, $score, $staff, $ip) {
		$this->set_party($party);
		$this->set_polling_unit($unit);
		$this->set_score($score);
		$this->set_staff($staff);
		$this->set_ip($ip);	
		date_default_timezone_set('America/New_York');
		// Get the current timestamp
		$timestamp = time();
		// Create the date time string
		$date_time = date('Y-m-d H:i:s', $timestamp);

		if (empty($this->system_message)) {
			
			$sql = "INSERT INTO announced_pu_results(polling_unit_uniqueid, party_abbreviation, party_score, entered_by_user, date_entered, user_ip_address) VALUES (?,?,?,?,?,?)";
			$stmt = $this->db->run($sql, [$unit, $party, $score, $staff, $date_time, $ip]);
			if ($stmt->rowCount() > 0) {
				$this->message('success', 'Result saved successfully');
			}
		} 

		return json_encode($this->system_message);
	}



	//this holds messages
	private function message($key, $value) {
        $this->system_message[$key] = $value;
	}


}