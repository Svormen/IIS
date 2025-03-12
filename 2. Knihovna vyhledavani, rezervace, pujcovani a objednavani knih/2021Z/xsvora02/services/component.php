<?php

class MainComponent
{
    private $pdo;

    // constructor that connects to the database
    function __construct()
    {
        $server = 'mysql:host=localhost;dbname=xzauko00;port=/var/run/mysql/mysql.sock';
        $username = 'xzauko00';
        $password = 'ejki4jin';
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );
        $this->pdo = new PDO($server, $username, $password, $options);
    }

    // function that returns genres of a books (if there is multiple times same genre in database, it will only return one of them because of distinct keyword)
    function get_genres()
    {
        $answer = $this->pdo->query('SELECT DISTINCT genre FROM book');
        return $answer;
    }

    // function that returns distinct isbns of books in lib_name library 
    function get_unique_book_isbn($lib_name)
    {
        $answer = $this->pdo->prepare('SELECT DISTINCT book_isbn FROM votes WHERE lib_name=?;');
        $answer->execute(array($lib_name));
        return $answer;
    }

    // function that retru nnumber of votes for specific book in specific library
    function num_of_votes($isbn, $lib_name)
    {
        $answer = $this->pdo->prepare('SELECT COUNT(book_isbn) as count FROM votes WHERE lib_name=? and book_isbn=?;');
        $answer->execute(array($lib_name, $isbn));
        return $answer->fetch();
    }

    function create_order($count, $isbn, $lib_name, $user_id)
    {
        $answer = $this->pdo->prepare('INSERT INTO orders(count, book_isbn, lib_name, user_id) VALUES(?,?,?,?);');
        $answer->execute(array($count, $isbn, $lib_name, $user_id));
        return;
    }

    // function that returns genres of a books (if there is multiple times same genre in database, it will only return one of them because of distinct keyword)
    function get_books()
    {
        $answer = $this->pdo->query('SELECT isbn, name, authors, publisher, genre FROM book');
        return $answer;
    }

    // function that returns genres of a books (if there is multiple times same genre in database, it will only return one of them because of distinct keyword)
    function get_book($isbn)
    {
        $answer = $this->pdo->prepare('SELECT isbn, name, authors, publisher, genre, rating, year FROM book WHERE isbn=?');
        $answer->execute(array($isbn));
        return $answer->fetch();
    }

    // function that returns genres of a books (if there is multiple times same genre in database, it will only return one of them because of distinct keyword)
    function get_total_sum_of_book($isbn)
    {
        $answer = $this->pdo->prepare('SELECT SUM(count) as count FROM availability WHERE book_isbn=?');
        $answer->execute(array($isbn));
        return $answer->fetch();
    }

    //function that returns id, mail and hashed password
    function get_mail_password($mail)
    {
        $answer = $this->pdo->prepare('SELECT id, mail, password, role FROM user WHERE mail=?');
        $answer->execute(array($mail));
        return $answer->fetch();
    }

    // function that returns filtered values from database
    function get_filtered($select)
    {
        $answer = $this->pdo->query($select);
        return $answer;
    }

    // function that cancel reservation that are given by isbn, name of library and id of user
    function cancel_reservation($isbn, $lib_name, $id)
    {
        $answer = $this->pdo->prepare('UPDATE reservation SET date_end=null, status=3 WHERE book_isbn=? and lib_name=? and user_id=?;');
        $answer->execute(array($isbn, $lib_name, $id));
        return;
    }

    // function that returns libraries from database
    function get_libs()
    {
        $answer = $this->pdo->query('SELECT * FROM library');
        return $answer;
    }

    // function that returns libraries from database
    function get_num_of_books_in_lib($isbn, $lib_name)
    {
        $answer = $this->pdo->prepare('SELECT count FROM availability WHERE book_isbn=? AND lib_name=?');
        $answer->execute(array($isbn, $lib_name));
        return $answer->fetch();
    }

    // function that checks if user already has reservation on specific book
    function reservation_exists($id, $isbn)
    {
        $answer = $this->pdo->prepare('SELECT COUNT(1) as count FROM reservation WHERE user_id =? and book_isbn=? and (status=1 or status=2 or status=4);');
        $answer->execute(array($id, $isbn));
        return $answer->fetch();
    }

    // function that servers for double checking when user sends reservation
    function reservation_created($id, $isbn)
    {
        $answer = $this->pdo->prepare('SELECT COUNT(1) as count FROM reservation WHERE user_id=? and book_isbn=? and status=1');
        $answer->execute(array($id, $isbn));
        return $answer->fetch();
    }

    // function that decrement bumber of books in availability table
    function decrement_count_in_availability($isbn, $lib_name)
    {
        $answer = $this->pdo->prepare('UPDATE availability SET count = count - 1 WHERE book_isbn=? and lib_name=?;');
        $answer->execute(array($isbn, $lib_name));
        return;
    }

    function update_availability($isbn, $lib_name, $count)
    {
        $answer = $this->pdo->prepare('UPDATE availability SET count = count + ? WHERE book_isbn=? and lib_name=?;');
        $answer->execute(array($count, $isbn, $lib_name));
        return;
    }

    function delete_from_reservations($id_res)
    {
        $answer = $this->pdo->prepare('DELETE FROM reservation WHERE id=?;');
        $answer->execute(array($id_res));
        return;
    }

    // function that returns all reservation of specific user
    function get_user_reservations($id)
    {
        $answer = $this->pdo->prepare('SELECT id, date_end, status, book_isbn, lib_name FROM reservation WHERE user_id =?;');
        $answer->execute(array($id));
        return $answer;
    }

    // function that is called almost every time and it updates status of reservation which runs out of time
    function auto_update_reservations()
    {
        $this->pdo->query('UPDATE reservation SET date_end=null, status=3 WHERE status=1 and current_date() > date_end;');
        $this->pdo->query('UPDATE reservation SET status=4 WHERE status=2 and current_date() > date_end;');
        return;
    }

    // function that returns library where works specific librarian
    function what_library($id)
    {
        $answer = $this->pdo->prepare('SELECT name FROM library WHERE user_id=?;');
        $answer->execute(array($id));
        return $answer->fetch();
    }

    // function that returns all reservations from specific library
    function get_reservations_in_library($lib_name)
    {
        $answer = $this->pdo->prepare('SELECT * FROM reservation WHERE lib_name=?;');
        $answer->execute(array($lib_name));
        return $answer;
    }

    // function that returns all reservations from all libs
    function get_reservations_in_all_libraries(){
        $answer = $this->pdo->query('SELECT * FROM reservation;');
        return $answer;
    }

    // function that returns all orders from all libraries
    function get_orders_in_all_libraries()
    {
        $answer = $this->pdo->query('SELECT * FROM orders;');
        return $answer;
    }
    function get_user($id)
    {
        $answer = $this->pdo->prepare('SELECT * FROM user WHERE id=?;');
        $answer->execute(array($id));
        return $answer->fetch();
    }

    function get_user_address($id)
    {
        $answer = $this->pdo->prepare('SELECT * FROM address WHERE id=?;');
        $answer->execute(array($id));
        return $answer->fetch();
    }

    // function that returns surname of specific user
    function get_surname($id)
    {
        $answer = $this->pdo->prepare('SELECT name, surname FROM user WHERE id=?;');
        $answer->execute(array($id));
        return $answer->fetch();
    }

    // function that is used by librarian when reader comes to library to pick up book
    function reservation_is_picked($id_res)
    {
        $answer = $this->pdo->prepare('UPDATE reservation SET status=2, date_end=DATE_ADD(current_date(), INTERVAL 30 day) WHERE id=?');
        $answer->execute(array($id_res));
        return;
    }

    // user has returned the book into a library
    function book_returned($id_res)
    {
        $answer = $this->pdo->prepare('UPDATE reservation SET status=5, date_end=null WHERE id=?');
        $answer->execute(array($id_res));
        return;
    }

    function order_done($count, $lib_name, $isbn)
    {
        $answer = $this->pdo->prepare('UPDATE availability SET count = count + ? WHERE book_isbn=? and lib_name=?;');
        $answer->execute(array($count, $isbn, $lib_name));
        return;
    }

    function delete_from_order($id_ord)
    {
        $answer = $this->pdo->prepare('DELETE FROM orders WHERE id=?;');
        $answer->execute(array($id_ord));
        return;
    }

    // function taht creates new reservation
    function add_reservation($isbn, $lib_name, $id)
    {
        $answer = $this->pdo->prepare('INSERT INTO reservation(date_end, status, book_isbn, lib_name, user_id) VALUES( DATE_ADD(current_date(), INTERVAL 7 day),1, ?, ?, ?);
        ');
        $answer->execute(array($isbn, $lib_name, $id));
        return;
    }

    // function that checks if user voted for specific book in library
    function user_vote($id, $isbn, $lib)
    {
        $answer = $this->pdo->prepare('SELECT COUNT(1) as count FROM votes WHERE user_id =? and book_isbn=? and lib_name=?;');
        $answer->execute(array($id, $isbn, $lib));
        return $answer->fetch();
    }

     // function that add vote to database
     function add_vote($id, $isbn, $lib)
     {
         $answer = $this->pdo->prepare('INSERT INTO votes (book_isbn, lib_name, user_id) VALUES (?,?,?)');
         $answer->execute(array($isbn, $lib, $id));
         return;
     }

    // function that returns name of book by isbn
    function get_book_by_isbn($isbn)
    {
        $answer = $this->pdo->prepare('SELECT name FROM book WHERE isbn=?');
        $answer->execute(array($isbn));
        return $answer->fetch();
    }

    // function for updating profile info without new password
    function update_user($data, $address_id, $id)
    {
        $stmt = $this->pdo->prepare('UPDATE address SET street=?, number=?, city=?, postal_code=? WHERE id=?');
        $stmt->execute([$data['street'], $data['number'], $data['city'], $data['postal_code'], $address_id]);
        unset($stmt);
        $stmt = $this->pdo->prepare('UPDATE user SET name=?, surname=?, mail=?, phone=? WHERE id=?');
        $stmt->execute([$data['name'], $data['surname'], $data['mail'], $data['phone'], $id]);
        return;
    }

    // function for updating profile info with new password
    function update_user_and_pass($data, $address_id, $id)
    {
        $stmt = $this->pdo->prepare('UPDATE address SET street=?, number=?, city=?, postal_code=? WHERE id=?');
        $stmt->execute([$data['street'], $data['number'], $data['city'], $data['postal_code'], $address_id]);
        unset($stmt);
        $pwd = password_hash($data['pass'], PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare('UPDATE user SET name=?, surname=?, mail=?, phone=?, password=? WHERE id=?');
        $stmt->execute([$data['name'], $data['surname'], $data['mail'], $data['phone'], $pwd, $id]);
        return;
    }

    function add_user($data)
    {
        $stmt = $this->pdo->prepare('INSERT INTO address (street, number, city, postal_code) VALUES (?, ?, ?, ?)');
        
        if ($stmt->execute([$data['street'], $data['number'], $data['city'], $data['postal_code']]))
        {
            $data['address_id'] = $this->pdo->lastInsertId();
            unset($stmt);
            $pwd = password_hash($data['password'], PASSWORD_DEFAULT);
            $role = 1;
            $stmt = $this->pdo->prepare('INSERT INTO user (name, surname, mail, phone, password, role, address_id) VALUES (?, ?, ?, ?, ?, ?, ?)');
            if ($stmt->execute([$data['name'], $data['surname'], $data['mail'], $data['phone'], $pwd, $role, $data['address_id']]))
            {
                $data['user_id'] = $this->pdo->lastInsertId();
                return $data;
            }

            return;
        }
        else
        {
            return FALSE;
        }
    }

    // function that returns my actual mail
    function my_mail($id)
    {
        $answer = $this->pdo->prepare('SELECT mail FROM user WHERE id=?');
        $answer->execute(array($id));
        return $answer->fetch();
    }

    //function return true if user with given mail is in databse
    function mail_exist($mail){
        $answer = $this->pdo->prepare('SELECT mail FROM user WHERE mail=?');
        $answer->execute(array($mail));
        if($answer->rowCount() > 0){
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    function delete_from_votes($isbn, $lib_name)
    {   
        $answer = $this->pdo->prepare('DELETE FROM votes WHERE book_isbn=? and lib_name=?;');
        $answer->execute(array($isbn, $lib_name));
        return;
    }

    //function return true if book with given isbn is in database
    function book_exist($isbn){
        $answer = $this->pdo->prepare('SELECT isbn FROM book WHERE isbn=?');
        $answer->execute(array($isbn));
        if($answer->rowCount() > 0){
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    //function add new book to database
    function add_book($data){
        $stmt = $this->pdo->prepare("INSERT INTO book(isbn, name, authors, year, publisher, genre, rating) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$data['isbn'], $data['name'], $data['authors'], $data['year'], $data['publisher'], $data['genre'], $data['rating']]);
    }

    //function add new book availability to database
    function add_new_book_availability($data, $lib_name){
        $stmt = $this->pdo->prepare("INSERT INTO availability(count, book_isbn, lib_name) VALUES (?, ?, ?)");
        $stmt->execute([0, $data['isbn'], $lib_name]);
    }

    //function return all users from database
    function get_users(){
        $answer = $this->pdo->prepare('SELECT id, mail, name, surname, role FROM user');
        $answer->execute();
        return $answer;
    }

    //function return libraries that do not have worker
    function get_empty_libraries(){
        $answer = $this->pdo->prepare('SELECT name FROM library where user_id is NULL');
        $answer->execute();
        return $answer;
    }

    //function return libraries where specific librarian work
    function get_librarian_lib($user_id){
        $answer = $this->pdo->prepare('SELECT name FROM library where user_id=?');
        $answer->execute([$user_id]);
        return $answer;
    }

    //function change role in table user
    function update_user_role($role, $user_id){
        $answer = $this->pdo->prepare('UPDATE user SET role = ? where id = ?');
        $answer->execute([$role , $user_id]);
        return;
    }

    //function that set user to library
    function set_library($user_id, $lib){
        $answer = $this->pdo->prepare('UPDATE library SET user_id = ? where name = ?');
        $answer->execute([$user_id, $lib]);
        return;
    }

    //function that update user_id in library
    function update_library($lib){
        $answer = $this->pdo->prepare('UPDATE library SET user_id = NULL where name = ?');
        $answer->execute([$lib]);
        return;
    }

    //function return specific library
    function get_lib($name){
        $answer = $this->pdo->prepare('SELECT * FROM library where name=?');
        $answer->execute([$name]);
        return $answer->fetch();
    }

    //function that update information in library
    function update_all_in_library($data, $opening_hours, $lib_name){
        $answer = $this->pdo->prepare('UPDATE library SET opening_hours = ?, description = ?  where name = ?');
        $answer->execute([$opening_hours, $data['description'], $lib_name]);
        return;
    }

    //function that update information in library
    function update_in_library($opening_hours, $lib_name){
        $answer = $this->pdo->prepare('UPDATE library SET opening_hours = ?  where name = ?');
        $answer->execute([$opening_hours, $lib_name]);
        return;
    }

    //function that update information in address
    function update_address($data, $address_id){
        $answer = $this->pdo->prepare('UPDATE address SET street = ?, number = ?, postal_code = ?, city = ?  where id = ?');
        $answer->execute([$data['street'], $data['number'], $data['postal_code'], $data['city'] , $address_id]);
        return;
    }

    //function that add new library and address to database
    function add_library($data, $opening_hours)
    {
        $stmt = $this->pdo->prepare('INSERT INTO address (street, number, city, postal_code) VALUES (?, ?, ?, ?)');
        
        if ($stmt->execute([$data['street'], $data['number'], $data['city'], $data['postal_code']]))
        {
            $data['address_id'] = $this->pdo->lastInsertId();
            unset($stmt);

            $stmt = $this->pdo->prepare('INSERT INTO library (name, opening_hours, description, address_id) VALUES (?, ?, ?, ?)');
            $stmt->execute([$data['name'], $opening_hours, $data['description'], $data['address_id']]);            
        }
        return;
    }

    //function return true if library name exist in database
    function library_exist($name){
        $answer = $this->pdo->prepare('SELECT name FROM library WHERE name=?');
        $answer->execute(array($name));
        if($answer->rowCount() > 0){
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    //function insert 0 into count in availability, when new library is create
    function set_availability($isbn, $name)
    {
        $stmt = $this->pdo->prepare('INSERT INTO availability(count, book_isbn, lib_name) VALUES (0, ?, ?)');        
        $stmt->execute([$isbn, $name]);
    }
}

?>