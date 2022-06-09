<?php
namespace Playground\tests;

use PHPUnit\Framework\TestCase;
use Playground\Tree;
use Playground\Node;

class TreeTest extends TestCase
{
    public function test_it_creates_tree_and_add_Nodes(){
        $data = [5,2,9,4,1,6];
        $tree = new Tree();

        foreach($data as $d){
            $tree->addNode(new Node($d));
        }

        $this->assertTrue($tree->getSize() == 6);
    }

    public function test_it_can_remove_nodes(){
        $data = [5,2,9,4,1,6];
        $tree = new Tree();

        foreach($data as $d){
            $tree->addNode(new Node($d));
        }

        $this->assertTrue($tree->getSize() == 6);
        $tree->removeNode(2);
        $this->assertTrue($tree->getSize() == 5);
    }

    public function test_it_can_search_nodes(){
        $data = [5,2,9,4,1,6];
        $tree = new Tree();

        foreach($data as $d){
            $tree->addNode(new Node($d));
        }

        $node = $tree->search(9);
        $this->assertTrue($node->val == 9);
    }

    public function test_it_can_add_extra_node(){
        $data = [5,2,9,4,1,6];
        $tree = new Tree();

        foreach($data as $d){
            $tree->addNode(new Node($d));
        }

        $this->assertTrue($tree->getSize() == 6);
        $tree->addNode(new Node(10));
        $this->assertTrue($tree->getSize() == 7);
    }
    
}