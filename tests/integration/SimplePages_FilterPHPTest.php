<?php
/**
 * @version $Id$
 * @copyright Center for History and New Media, 2010
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 **/

class SimplePages_FilterPHPTest extends SimplePages_Test_AppTestCase
{
    protected $_isAdminTest = true;
       
    public function testFilterPHPFromSimplePageText()
    {
        set_option('simple_pages_filter_page_content', '1');
        $this->assertEquals('1', get_option('simple_pages_filter_page_content'));
        
        $form = array(
            'title'=> 'About',
            'slug' => 'about',
            'text' => '<?php echo "Bob"; ?>by',
            'parent_id' => '0',
            'order' => '1',
            'add_to_public_nav' => '1',
            'is_home_page' => '0',
            'is_published' => '1'
        );
        
        $this->getRequest()->setPost($form);
        $this->getRequest()->setMethod('post');
        $this->dispatch('simple-pages/index/edit/id/1');
        
        $page = $this->db->getTable('SimplePagesPage')->find(1);
        $this->assertEquals('about', $page->slug);
        // Escaping the ampersand has the same effect as stripping the entire
        // segment would.      
        $this->assertEquals('&lt;?php echo "Bob"; ?&gt;by', $page->text);
    }
    
    public function testNoFilterPHPFromSimplePageText()
    {
        set_option('simple_pages_filter_page_content', '0');
        $this->assertEquals('0', get_option('simple_pages_filter_page_content'));
        
        $form = array(
            'title'=> 'About',
            'slug' => 'about',
            'text' => '<?php echo "Bob"; ?>by',
            'parent_id' => '0',
            'order' => '1',
            'add_to_public_nav' => '1',
            'is_home_page' => '0',
            'is_published' => '1'
        );
        
        $this->getRequest()->setPost($form);
        $this->getRequest()->setMethod('post');
        $this->dispatch('simple-pages/index/edit/id/1');
        
        $page = $this->db->getTable('SimplePagesPage')->find(1);
        $this->assertEquals('about', $page->slug);      
        $this->assertEquals('<?php echo "Bob"; ?>by', $page->text);
    }
}