<?php
use PHPUnit\Framework\TestCase;

class AdminLoginTest extends TestCase
{
    private $con;
    
    protected function setUp(): void
    {
        $this->con = mysqli_connect("localhost", "root", "shreevishnu@1", "myhmsdb");
    }
    
    public function testAdminLogin()
    {
        $_POST['username1'] = 'admin';
        $_POST['password1'] = 'admin123';
        
        $query = "SELECT * FROM admintb WHERE username='admin' AND password='admin123'";
        $result = mysqli_query($this->con, $query);
        
        $this->assertEquals(1, mysqli_num_rows($result));
    }
    
    public function testInvalidAdminLogin()
    {
        $_POST['username1'] = 'wrongadmin';
        $_POST['password1'] = 'wrongpass';
        
        $query = "SELECT * FROM admintb WHERE username='wrongadmin' AND password='wrongpass'";
        $result = mysqli_query($this->con, $query);
        
        $this->assertEquals(0, mysqli_num_rows($result));
    }
    
    protected function tearDown(): void
    {
        mysqli_close($this->con);
    }
}