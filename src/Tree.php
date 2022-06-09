<?php
namespace  Playground;

use Playground\Node;

class Tree{
    public $root = null;
    protected $size = 0;

    /**
     *
     * @param $root
     */
    public function __construct($root = null)
    {
        $this->root = $root;
        if($root){
            $this->size += 1;
        }
    }

    public function removeNode($val) : bool{
        if(!$this->root){
            return false;
        }

        $current = $this->root;
        $parent = $current;
        $hasReachedEnd = false;

        while(!$hasReachedEnd){
            if($current->val == $val){
                $this->remove($current,$parent);
                $this->size -= 1;
                $hasReachedEnd = true;
                return true;
            }
            else if($val < $current->val){
                if(!$current->left){
                    $hasReachedEnd = true;
                    return false;
                }
                $parent = $current;
                $current = $current->left;
            }
            else if($val > $current->val){
                if(!$current->right){
                    $hasReachedEnd = true;
                    return false;
                }
                $parent = $current;
                $current = $current->right;
            }
        }
    }

    /**
     *
     * @param Node $node
     * @return void
     */
    public function addNode(Node $node) : void{
        if(!$this->root) {
            $this->root = $node;
        }
        else{
            $current = $this->root;
            $added = false;
            while(!$added){
                if($node->val > $current->val){
                    if(!$current->right){
                        $current->right = $node;
                        $added = true;
                    }
                    else{
                        $current = $current->right;
                    }
                }else{
                    if(!$current->left){
                        $current->left = $node;
                        $added = true;
                    }
                    else{
                        $current = $current->left;
                    }
                }
            }
        }

        $this->size += 1;
    }

    public function search($item){
        if(!$this->root){
            return null;
        }
        if($item === $this->root->val){
            return $this->root;
        }
        $reachedEnd = false;
        $current = $this->root;
        while(!$reachedEnd){
            if($current->val === $item){
                return $current;
            }
            if($item > $current->val){
                if(!$current->right){
                    $reachedEnd = true;
                }else{
                    $current = $current->right;
                }
            }else{
                if(!$current->left){
                    $reachedEnd = true;
                }else{
                    $current = $current->left;
                }
            }
        }

        return null;
    }

    /**
     *
     * @return array
     */
    public function breadthFirstSearch() : array{
        if($this->root == null){
            return [];
        }

        $queue = [$this->root];
        $result = [];

        while(count($queue) > 0){
            $current = array_shift($queue);
            $result[] = $current;
            if($current->left){
                array_push($queue, $current->left);
            }
            if($current->right){
                array_push($queue, $current->right);
            }
        }

        return $result;
    }

    /**
     *
     * @return array
     */
    public function depthFirdtSearch() : array{
        if($this->root == null){
            return [];
        }
    
        $stack = [$this->root];
        $result = [];
    
        while(count($stack) > 0){
            $current = array_pop($stack);
            $result[] = $current;
            if($current->right){
                array_push($stack, $current->right);
            }
            if($current->left){
                array_push($stack, $current->left);
            }
        }
    
        return $result;
    }

    /**
     *
     * @param $current
     * @param $parent
     * @return void
     */
    protected function remove($current, $parent) : void{
        if(!$current->left && !$current->right){ //since no left and right nodes just remove it
            if($parent == $current){
                $this->root = null;
            }
            else if($current == $parent->left){
                $parent->left = null;
            }
            else if($current == $parent->right){
                $parent->parent = null;
            }
        }
        else if($current->left && !$current->right){ //since it has left node and not right then just replace the left node
            if($current == $parent->left){
                $parent->left = $current->left;
            }
            if($current == $parent->right){
                $parent->right = $current->left;
            }
        }
        else if($current->right && !$current->left){
            if($current == $parent->left){
                $parent->left = $current->right;
            }
            if($current == $parent->right){
                $parent->right = $current->right;
            }
        }
        else if($current->left && $current->right){ 
           $this->repositionNodes($current,$parent);
        }
    }

    /**
     * it has left and right node, so we have to find the least node in the right
     * and put it in the position we are removing this node from
     * minding if the node has a right  node, it has to become the left node of where it is being moved from
     *
     * @param $current
     * @param $parent
     * @return void
     */
    protected function repositionNodes($current,$parent) : void{
        $childParent = $current->right;
        $least = $childParent;
        $hasMoreLeftNode = $least->left;
        while($hasMoreLeftNode){
            if($least->val > $least->left->val){
                $childParent = $least;
                $least = $least->left;
                $hasMoreLeftNode = $least->left;
            }
        }

        if($childParent != $least){
            if($least->right){
                $childParent->left = $least->right;
            }

            $least->right = $current->right;
        }

        if($parent->left == $current){
            $parent->left = $least;
        }
        else if($parent->right == $current){
            $parent->right = $least;
        }
        $least->left = $current->left;
    }

    /**
     *
     * @return integer
     */
    public function getSize() : int{
        return $this->size;
    }

    /**
     *
     * @param array $nodes
     * @return string
     */
    public static function toString(array $nodes): string{
        $values = array_column($nodes,'val');
        return implode(',', $values);
    }
}
