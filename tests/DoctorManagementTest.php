<?php
use PHPUnit\Framework\TestCase;

class DoctorManagementTest extends TestCase
{
    private $con;
    
    protected function setUp(): void
    {
        $this->con = mysqli_connect("localhost", "root", "shreevishnu@1", "myhmsdb");
        
        // Add test doctor for deletion test
        $query = "INSERT INTO doctb (username, password, email, spec, docFees) 
                 VALUES ('testdoc', 'test123', 'test@doc.com', 'General', 500)";
        mysqli_query($this->con, $query);
    }
    
    public function testAddDoctor()
    {
        $query = "INSERT INTO doctb (username, password, email, spec, docFees) 
                 VALUES ('newdoc', 'doc123', 'new@doc.com', 'Cardiologist', 600)";
        $result = mysqli_query($this->con, $query);
        $this->assertTrue($result);
        
        // Verify doctor was added
        $query = "SELECT * FROM doctb WHERE username='newdoc'";
        $result = mysqli_query($this->con, $query);
        $this->assertEquals(1, mysqli_num_rows($result));
    }

    public function testDeleteDoctor()
    {
        // Verify test doctor exists
        $query = "SELECT * FROM doctb WHERE username='testdoc'";
        $result = mysqli_query($this->con, $query);
        $this->assertEquals(1, mysqli_num_rows($result));
        
        // Delete doctor
        $query = "DELETE FROM doctb WHERE username='testdoc'";
        $result = mysqli_query($this->con, $query);
        $this->assertTrue($result);
        
        // Verify doctor was deleted
        $query = "SELECT * FROM doctb WHERE username='testdoc'";
        $result = mysqli_query($this->con, $query);
        $this->assertEquals(0, mysqli_num_rows($result));
    }
    
    protected function tearDown(): void
    {
        // Clean up test data
        mysqli_query($this->con, "DELETE FROM doctb WHERE username='newdoc'");
        mysqli_query($this->con, "DELETE FROM doctb WHERE username='testdoc'");
        mysqli_close($this->con);
    }
}