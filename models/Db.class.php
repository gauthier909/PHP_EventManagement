<?php
class Db
{
    private static $instance = null;
    private $_db;

    private function __construct()
    {
        try {
            $this->_db = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', 'root');
            $this->_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
        } 
		catch (PDOException $e) {
		    die('Erreur de connexion à la base de données : '.$e->getMessage());
        }
    }


    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

	

     public function insert_user($first_name, $last_name, $num_phone , $e_mail , $address , $num_account , $photo , $password , $coach , $staff , $checked ) {

        $query = 'INSERT INTO users (first_name, last_name, num_phone , e_mail , address , num_account , photo , password , coach , staff , checked) values (:first_name, :last_name, :num_phone , :e_mail , :address , :num_account , :photo , :password , :coach , :staff , :checked)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':first_name',$first_name);
        $ps->bindValue(':last_name',$last_name);
        $ps->bindValue(':num_phone',$num_phone);
        $ps->bindValue(':e_mail',$e_mail);
        $ps->bindValue(':address',$address);
        $ps->bindValue(':num_account',$num_account);
        $ps->bindValue(':photo',$photo);
        $ps->bindValue(':password',$password);
        $ps->bindValue(':coach',$coach);
        $ps->bindValue(':staff',$staff);
        $ps->bindValue(':checked',$checked);
        return $ps->execute();
    }


    public function select_membres($keyword='') {
        if ($keyword != '') {
            $keyword = str_replace("%", "\%", $keyword);
            $query = "SELECT * FROM users WHERE first_name LIKE :keyword OR last_name LIKE :keyword COLLATE utf8_bin ORDER BY checked ASC ";
            $ps = $this->_db->prepare($query);
            $ps->bindValue(':keyword',"%$keyword%");
        } else {
            $query = 'SELECT * FROM users ORDER BY checked ASC';
            $ps = $this->_db->prepare($query);
        }

    
        $ps->execute(); 

        $tableau = array();
        while ($row = $ps->fetch()) {       
            $tableau[] = new Users($row->no_user , $row->first_name, $row->last_name, $row->num_phone,$row->e_mail,$row->address,$row->num_account,$row->photo,$row->password,$row->coach,$row->staff,$row->checked);
        }
        
        return $tableau;
    }


    public function valide_user($no_user) {
        $query = 'UPDATE users SET checked = 1 WHERE no_user=:no_user';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':no_user',$no_user);
        return $ps->execute();
    }

    public function doublon_user($e_mail){
        $query = 'SELECT e_mail FROM users WHERE e_mail=:e_mail';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':e_mail',$e_mail);
        $ps->execute();
        if ($ps->rowcount() == 0){
            return true;
        }

        return false;
    }

    public function connexion_user($e_mail,$password) {
        $query = 'SELECT password FROM users WHERE e_mail=:e_mail AND checked = 1';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':e_mail',$e_mail);
        $ps->execute();
        if ($ps->rowcount() == 0)
            return false;
        $hash = $ps->fetch()->password;
        return password_verify($password, $hash);
    }

    public function select_user($no_user) {
        $query = 'SELECT * FROM users WHERE no_user=:no_user';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':no_user',$no_user);
        $ps->execute();
        $row = $ps->fetch();    
        return new Users($row->no_user , $row->first_name, $row->last_name, $row->num_phone,$row->e_mail,$row->address,$row->num_account,$row->photo,$row->password,$row->coach,$row->staff,$row->checked);
    }

    public function update_user($no_user,$role) {
        if($role == 'Membre'){$query = 'UPDATE users SET coach= 0 , staff = 0 WHERE no_user=:no_user';}
        if($role == 'Membre Responsable'){$query = 'UPDATE users SET staff = 1 , coach = 0 WHERE no_user=:no_user';}
        if($role == 'Coach'){$query = 'UPDATE users SET coach =1 , staff = 0 WHERE no_user=:no_user';}    
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':no_user',$no_user);
        return $ps->execute();
    }

    public function checkstaff($e_mail){
        $query = 'SELECT e_mail FROM users WHERE e_mail=:e_mail AND staff = 1';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':e_mail',$e_mail);
        $ps->execute();
        if ($ps->rowcount() == 0){
            return false;
        }

        return true;

    }

    public function last_staff($no_user){
        $query = 'SELECT * FROM users WHERE no_user=:no_user AND staff = 1';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':no_user',$no_user);
        $ps->execute();
        if ($ps->rowcount() == 0){
            return false;
        }

        return true;

    }

    public function count_staff(){
        $query = 'SELECT * FROM users WHERE staff = 1';
        $ps = $this->_db->prepare($query);
        $ps->execute();
        if ($ps->rowcount() != 1){
            return false;
        }

        return true;
    }

    public function checkcoach($e_mail){
        $query = 'SELECT e_mail FROM users WHERE e_mail=:e_mail AND coach = 1';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':e_mail',$e_mail);
        $ps->execute();
        if ($ps->rowcount() == 0){
            return false;
        }

        return true;

    }

    public function select_email() {
        $query = 'SELECT e_mail FROM users';
    }

    public function create_cotisation($annee_mf , $cost_mf){
        $query = 'INSERT INTO membership_fees (annee_mf ,cost_mf) values (:annee_mf , :cost_mf)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':annee_mf',$annee_mf);
        $ps->bindValue(':cost_mf',$cost_mf);
        return $ps->execute();
    
  } 



    public function create_event($date_start , $date_end , $title , $description , $location , $cost , $url){
        $query = 'INSERT INTO events (date_start, date_end , title , description , location , cost , url) values (:date_start , :date_end , :title , :description , :location , :cost , :url)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':date_start',$date_start);
        $ps->bindValue(':date_end',$date_end);
        $ps->bindValue(':title',$title);
        $ps->bindValue(':description',$description);
        $ps->bindValue(':location',$location);
        $ps->bindValue(':cost',$cost);
        $ps->bindValue(':url',$url);
        return $ps->execute();
    }


     public function select_cost_membership_fees($annee) {
        
        $query = 'SELECT cost_mf FROM membership_fees WHERE annee_mf = :annee';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':annee',$annee);
        $ps->execute();
       $tableau = array();
      while ($row = $ps->fetch()) {
        $tableau[] = new Membership_fees($annee ,$row->cost_mf);
      }
      return $tableau;   
        
    }

    //public function select_events(){
     //   $query = 'SELECT * FROM events ORDER BY num_event ASC';
    //   $ps = $this->_db->prepare($query);
     //   $ps->execute(); 
     //   $tableau = array();
    //    while ($row = $ps->fetch()) {       
    ///        $tableau[] = new Events($row->num_event , $row->date_start, $row->date_end ,$row->title , $row->description , $row->location , $row->cost , $row->url);
    //    }
    //    return $tableau;
  //  }    

    public function select_events(){
      $query = 'SELECT * FROM events';
      $ps = $this->_db->prepare($query);
      $ps->execute();
      $tableau = array();
      while ($row = $ps->fetch()) {
        $tableau[] = new Event($row->num_event ,$row->date_start,$row->date_end,$row->title,$row->description,
      $row->location, $row->cost, $row->url);
      }
      return $tableau;
    }

    public function exist_mf($annee_mf){
        $query = 'SELECT * FROM membership_fees WHERE annee_mf=:annee_mf';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':annee_mf',$annee_mf);
        $ps->execute();
        if ($ps->rowcount() == 0){
            return false;
        }

        return true;

    }


    public function select_enOrdre($annee){


        $query= 'SELECT * FROM users u, payements p  WHERE u.no_user = p.no_user AND p.annee_mf = :annee AND p.has_payed = 1';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':annee',$annee);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {       
            $tableau[] = new Users($row->no_user , $row->first_name, $row->last_name, $row->num_phone,$row->e_mail,$row->address,$row->num_account,$row->photo,$row->password,$row->coach,$row->staff,$row->checked);
        }
        return $tableau; 
  
    }
       
    public function select_pasEnOrdre($annee){
        $query= 'SELECT * FROM users u WHERE u.no_user NOT IN (SELECT no_user FROM payements WHERE annee_mf = :annee AND has_payed=1)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':annee',$annee);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {       
            $tableau[] = new Users($row->no_user , $row->first_name, $row->last_name, $row->num_phone,$row->e_mail,$row->address,$row->num_account,$row->photo,$row->password,$row->coach,$row->staff,$row->checked);
        }
        return $tableau;
    }

    public function list_mail($annee){
        $query= 'SELECT * FROM users u WHERE u.no_user NOT IN (SELECT no_user FROM payements WHERE annee_mf = :annee AND has_payed=1)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':annee',$annee);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {       
            $tableau[] = new Users($row->no_user , $row->first_name, $row->last_name, $row->num_phone,$row->e_mail,$row->address,$row->num_account,$row->photo,$row->password,$row->coach,$row->staff,$row->checked);
        }
        return $tableau;
    }

    public function select_event_forUpdate($num_event){
        $query = 'SELECT * FROM events WHERE num_event= :num_event';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':num_event',$num_event);
        $ps->execute();
        $row = $ps->fetch();    
        return new Event($row->num_event ,$row->date_start,$row->date_end,$row->title,$row->description,
      $row->location, $row->cost, $row->url);
    }
    
    public function add_payement($no_user,$annee_mf,$amount,$has_payed){
        $query = 'INSERT INTO payements (no_user , annee_mf , amount, has_payed) values (:no_user , :annee_mf , :amount , :has_payed)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':no_user',$no_user);
        $ps->bindValue(':annee_mf',$annee_mf);
        $ps->bindValue(':amount',$amount);
        $ps->bindValue(':has_payed',$has_payed);
        return $ps->execute();
    }

    public function update_event($num_event,$date_start, $date_end, $title, $description,
  $location, $cost, $url) {
        $query = 'UPDATE events SET date_start=:date_start , date_end=:date_end , title=:title , description=:description , location=:location , cost =:cost, url =:url WHERE num_event=:num_event';    
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':date_start',$date_start);
        $ps->bindValue(':date_end',$date_end);
        $ps->bindValue(':title',$title);
        $ps->bindValue(':description',$description);
        $ps->bindValue(':location',$location);
        $ps->bindValue(':cost',$cost);
        $ps->bindValue(':url',$url);
        $ps->bindValue(':num_event',$num_event);
        return $ps->execute();
    }

    public function exist_payement($no_user , $annee_mf){
        $query = 'SELECT no_user FROM payements WHERE no_user=:no_user AND annee_mf=:annee_mf';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':no_user',$no_user);
        $ps->bindValue(':annee_mf',$annee_mf);
        $ps->execute();
        if ($ps->rowcount() == 0){
            return false;
        }

        return true;
    }

    public function update_payement($no_user,$annee_mf,$amount,$has_payed){
        $query = 'UPDATE payements SET amount=:amount , has_payed=:has_payed WHERE no_user=:no_user AND annee_mf=:annee_mf';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':annee_mf',$annee_mf);
        $ps->bindValue(':amount',$amount);
        $ps->bindValue(':has_payed',$has_payed);
        $ps->bindValue(':no_user',$no_user);
        return $ps->execute();
    }

    public function select_payements($no_user,$annee_mf){
        $query='SELECT amount FROM payements WHERE no_user=:no_user AND annee_mf=:annee_mf ';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':no_user',$no_user);
        $ps->bindValue(':annee_mf',$annee_mf);
        $ps->execute();
       $tableau = array();
      while ($row = $ps->fetch()) {
        $tableau[] = new Payements($no_user,$annee_mf ,$row->amount , 0);
      }
      return $tableau; 
        

    }

    public function select_annee_mf() {
        
        $query = 'SELECT * FROM membership_fees ORDER BY annee_mf DESC';
        $ps = $this->_db->prepare($query);
        $ps->execute();
       $tableau = array();
      while ($row = $ps->fetch()) {
        $tableau[] = new Membership_fees($row->annee_mf ,$row->cost_mf);
      }
      return $tableau;   
        
    }

    public function delete_payement($no_user , $annee_mf){
        $query = 'DELETE FROM payements WHERE no_user=:no_user AND annee_mf=:annee_mf';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':no_user',$no_user);
        $ps->bindValue(':annee_mf',$annee_mf);
        return $ps->execute();
    }

    public function pay_event($no_user,$num_event,$has_payed){
        $query = 'INSERT INTO registered (num_event , no_user , has_payed) values (:num_event, :no_user ,:has_payed)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':num_event',$num_event);
        $ps->bindValue(':no_user',$no_user);
        $ps->bindValue(':has_payed',$has_payed);
        return $ps->execute();
    }

    public function event_payed($no_user){
        $query = 'SELECT DISTINCT * FROM events e , registered r WHERE e.num_event=r.num_event AND r.no_user=:no_user AND r.has_payed = 1';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':no_user',$no_user);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {
        $tableau[] = new Event($row->num_event ,$row->date_start,$row->date_end,$row->title,$row->description,
      $row->location, $row->cost, $row->url);
        }
        return $tableau;
       
    }

    public function exist_event_payed($no_user , $num_event){
        $query = 'SELECT * FROM registered WHERE no_user=:no_user AND num_event=:num_event';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':no_user',$no_user);
        $ps->bindValue(':num_event',$num_event);
        $ps->execute();
        if ($ps->rowcount() == 0){
            return false;
        }

        return true;
    }

    public function update_pay_event($no_user , $num_event , $has_payed){
        $query = 'UPDATE registered SET has_payed=:has_payed  WHERE no_user=:no_user AND num_event=:num_event';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':no_user',$no_user);
        $ps->bindValue(':num_event',$num_event);
        $ps->bindValue(':has_payed',$has_payed);
        
        return $ps->execute();
    }


    public function list_registered($num_event){
        $query = 'SELECT * FROM registered r , users u WHERE r.num_event= :num_event AND r.no_user = u.no_user' ;
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':num_event',$num_event);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {
        $tableau[] = new Users($row->no_user , $row->first_name, $row->last_name, $row->num_phone,$row->e_mail,$row->address,$row->num_account,$row->photo,$row->password,$row->coach,$row->staff,$row->checked);
    }
    return $tableau;
    }

    public function list_interested($num_event){
        $query = 'SELECT * FROM interests i , users u WHERE i.num_event= :num_event AND i.no_user = u.no_user' ;
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':num_event',$num_event);
        $ps->execute();
        $tableau = array();
        while ($row = $ps->fetch()) {
        $tableau[] = new Users($row->no_user , $row->first_name, $row->last_name, $row->num_phone,$row->e_mail,$row->address,$row->num_account,$row->photo,$row->password,$row->coach,$row->staff,$row->checked);
    }
    return $tableau;
    }

         



    // CODE ALEXANDRE 15 MAI

   
    #selects one event
    public function select_one_event($num_event){
      $query = 'SELECT * FROM events WHERE num_event=:num_event';
      $ps=$this->_db->prepare($query);
      $ps->bindValue(':num_event', $num_event);
      $ps->execute();
      $row = $ps->fetch();

      return new Event($row->num_event, $row->date_start,$row->date_end,$row->title,$row->description,
    $row->location, $row->cost, $row->url);
    }

    #selects one interest
    public function select_interest($no_user, $num_event){
      $query = 'SELECT * FROM interests WHERE no_user=:no_user AND num_event=:num_event';
      $ps=$this->_db->prepare($query);
      $ps->bindValue(':no_user', $no_user);
      $ps->bindValue(':num_event', $num_event);
      $ps->execute();
      $row=$ps->fetch();
      if($row==false){
        return NULL;
      }
      return new Interest($row->num_event, $row->no_user, $row->is_interested);
    }

    public function insert_interest($no_user, $num_event){
      $query = 'INSERT INTO interests (num_event, no_user) values (:num_event,:no_user)';
      $ps=$this->_db->prepare($query);
      $ps->bindValue(':no_user', $no_user);
      $ps->bindValue(':num_event', $num_event);
      return $ps->execute();
    }

    public function delete_interest($no_user, $num_event){
      $query = 'DELETE FROM interests WHERE no_user=:no_user AND num_event=:num_event LIMIT 1';
        $ps = $this->_db->prepare($query);
      $no_user = str_replace("'", "", $no_user);
      $num_event = str_replace("'", "", $num_event);
        $ps->bindValue(':no_user', $no_user);
      $ps->bindValue(':num_event',$num_event);
        return $ps->execute();
    }

    public function select_registered($no_user, $num_event){
      $query = 'SELECT * FROM registered WHERE no_user=:no_user AND num_event=:num_event';
      $ps=$this->_db->prepare($query);
      $ps->bindValue(':no_user', $no_user);
      $ps->bindValue(':num_event', $num_event);
      $ps->execute();
      $row=$ps->fetch();
      if($row==false)
        return null;
      return new Registered($row->num_event, $row->user, $row->has_payed);
    }

    public function insert_registered($no_user, $num_event){
      $query = 'INSERT INTO registered (num_event, no_user) values (:num_event,:no_user)';
      $ps=$this->_db->prepare($query);
      $ps->bindValue(':no_user', $no_user);
      $ps->bindValue(':num_event', $num_event);
      return $ps->execute();
    }

    #selects all the training plans
    public function select_plans(){
      $query = 'SELECT * FROM plans';
      $ps = $this->_db->prepare($query);
      $ps->execute();
      $tableau = array();
      while ($row = $ps->fetch()) {
        $tableau[] = new Plan($row->num_plan, $row->name, $row->file_plan);
      }
      return $tableau;
    }

    public function select_one_plan($num_plan){
      $query = 'SELECT * FROM plans WHERE num_plan=:num_plan';
      $ps = $this->_db->prepare($query);
      $ps->bindValue(':num_plan',$num_plan);
      $ps->execute();
      $row = $ps->fetch();
      return new Plan($row->num_plan, $row->name, $row->file_plan);
    }

    public function select_followed_plan($no_user){
      $query = 'SELECT * FROM plans p, follow f, users u WHERE f.no_user=:no_user AND f.num_plan=p.num_plan';
      $ps = $this->_db->prepare($query);
      $ps->bindValue(':no_user',$no_user);
      $ps->execute();
      $row = $ps->fetch();
      return new Plan($row->num_plan, $row->name, $row->file_plan);
    }

    public function select_followed_plan_base($name){
      $query = 'SELECT * FROM plans WHERE name=:name';
      $ps = $this->_db->prepare($query);
       $ps->bindValue(':name',$name);
      $ps->execute();
      $row = $ps->fetch();
      return new Plan($row->num_plan, $row->name, $row->file_plan);
    }

    public function exist_followed_plan($no_user){
        $query = 'SELECT * FROM plans p, follow f, users u WHERE f.no_user=:no_user AND f.num_plan=p.num_plan';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':no_user',$no_user);
        $ps->execute();
        if ($ps->rowcount() == 0){
            return false;
        }

        return true;
    }

    #deletes one training plan from the database
    public function delete_plan($num_plan){
      $query = 'DELETE FROM plans WHERE num_plan=:num_plan LIMIT 1';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':num_plan',$num_plan);
        return $ps->execute();
    }

    #inserts a plan into the database
    public function insert_plan($name, $file_plan){
      $query = 'INSERT INTO plans (name, file_plan) values (:name,:file_plan)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':name',$name);
        $ps->bindValue(':file_plan',$file_plan);
        return $ps->execute();
    }

    public function insert_details_plan($date_training, $day_program, $num_plan){
      $query = 'INSERT INTO plans (date_training, day_program, num_plan) values (:date_training,:day_program,:num_plan)';
        $ps = $this->_db->prepare($query);
        $ps->bindValue(':date_training',$date_training);
        $ps->bindValue(':day_program',$day_program);
      $ps->bindValue(':num_plan',$num_plan);
        return $ps->execute();
    }
    #selects the details of the correct plan in the database
    public function select_details_plan($num_plan){
      $query = 'SELECT * FROM details_plan WHERE num_plan=:num_plan';
      $ps = $this->_db->prepare($query);
      $ps->bindValue(':num_plan',$num_plan);
      $ps->execute();
      $tableau = array();
      while ($row = $ps->fetch()) {
        $tableau[] = new PlanDetails($row->date_training, $row->day_program, $row->num_plan);
      }
      return $tableau;
    }

    public function update_detail($num_plan, $date_training, $day_program){
      $query = 'UPDATE details_plan SET day_program=:day_program WHERE date_training=:date_training AND num_plan=:num_plan';
      $ps = $this->_db->prepare($query);
      $ps->bindValue(':num_plan',$num_plan);
      $ps->bindValue(':day_program', $day_program);
      $ps->bindValue(':date_training', $date_training);
      return $ps->execute();
    }

    public function select_info_user($e_mail){
      $query = 'SELECT * FROM users WHERE e_mail=:e_mail';
      $ps = $this->_db->prepare($query);
      $ps->bindValue(':e_mail',$e_mail);
      $ps->execute();
      $row = $ps->fetch();
      return new Users($row->no_user , $row->first_name, $row->last_name, $row->num_phone,$row->e_mail,$row->address,$row->num_account,$row->photo,$row->password,$row->coach,$row->staff,$row->checked);
    }

    public function update_onevalue_user($login, $last_name, $first_name, $num_phone, $address, $num_account){
      $query = 'UPDATE users SET last_name=:last_name, first_name=:first_name, num_phone=:num_phone, address=:address, num_account=:num_account WHERE e_mail =:login';
      $ps = $this->_db->prepare($query);
      $ps->bindValue(':last_name', $last_name);
      $ps->bindValue(':first_name', $first_name);
      $ps->bindValue(':num_phone', $num_phone);
      $ps->bindValue(':address', $address);
      $ps->bindValue(':num_account', $num_account);
      $ps->bindValue(':login', $login);
      return $ps->execute();
    }

    public function update_e_mail_user($login, $e_mail){
        $query='UPDATE users SET e_mail=:e_mail WHERE e_mail=:login';
        $ps=$this->_db->prepare($query);
        $ps->bindValue(':e_mail', $e_mail);
        $ps->bindValue(':login', $login);
        return $ps->execute();
    }

    public function update_password_user($login, $password){
      $query='UPDATE users SET password=:password WHERE e_mail=:login';
      $ps=$this->_db->prepare($query);
      $ps->bindValue(':password', $password);
      $ps->bindValue(':login', $login);
      return $ps->execute();
    }
    public function update_photo_user($login, $photo){
      $query='UPDATE users SET photo=:photo WHERE e_mail=:login';
      $ps=$this->_db->prepare($query);
      $ps->bindValue(':photo', $photo);
      $ps->bindValue(':login', $login);
      return $ps->execute();
    }

    public function select_marker(){
      $query='SELECT * FROM markers WHERE id=1';
      $ps = $this->_db->prepare($query);
      $ps->execute();
      $row = $ps->fetch();
      return new Marker($row->id, $row->name, $row->address, $row->lat, $row->lng, $row->type);
    }


}

