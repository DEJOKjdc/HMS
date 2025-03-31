<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    private $con;
    
    protected function setUp(): void
    {
        $this->con = mysqli_connect("localhost", "root", "shreevishnu@1", "myhmsdb");
    }
    
    public function testAdminLogin()
    {
        $query = "SELECT * FROM admintb WHERE username='admin' AND password='admin123'";
        $result = mysqli_query($this->con, $query);
        $this->assertEquals(1, mysqli_num_rows($result));
    }

    public function testDoctorLogin()
    {
        $query = "SELECT * FROM doctb WHERE username='Ganesh' AND password='ganesh123'";
        $result = mysqli_query($this->con, $query);
        $this->assertEquals(1, mysqli_num_rows($result));
    }

    public function testPatientLogin()
    {
        $query = "SELECT * FROM patreg WHERE email='ram@gmail.com' AND password='ram123'";
        $result = mysqli_query($this->con, $query);
        $this->assertEquals(1, mysqli_num_rows($result));
    }

    public function testInvalidLogin()
    {
        // Test invalid admin login
        $query = "SELECT * FROM admintb WHERE username='wrongadmin' AND password='wrongpass'";
        $result = mysqli_query($this->con, $query);
        $this->assertEquals(0, mysqli_num_rows($result));

        // Test invalid doctor login
        $query = "SELECT * FROM doctb WHERE username='wrongdoc' AND password='wrongpass'";
        $result = mysqli_query($this->con, $query);
        $this->assertEquals(0, mysqli_num_rows($result));

        // Test invalid patient login
        $query = "SELECT * FROM patreg WHERE email='wrong@email.com' AND password='wrongpass'";
        $result = mysqli_query($this->con, $query);
        $this->assertEquals(0, mysqli_num_rows($result));
    }
    
    protected function tearDown(): void
    {
        mysqli_close($this->con);
    }
}