# Tree Data Structure in PHP

## git clone https://github.com/myrealjay/Tree-Data-Structure.git

### This is a php Tree implement
### It covers adding nodes, removing nodes, depth first search and breadth first search traversals

```
use Playground\Tree;
use Playground\Node;

$data = [5,2,9,4,1,6];

$tree = new Tree();

foreach($data as $d){
    $tree->addNode(new Node($d));
}

echo Tree::toString($tree->depthFirdtSearch());
echo "\n\n";
echo Tree::toString($tree->breadthFirstSearch());
echo "\n\n";

$tree->removeNode(9);
$tree->addNode(new Node(10));
$tree->addNode(new Node(11));
$tree->removeNode(10);
echo $tree->getSize()."\n";

$found = $tree->search(11);
print_r($found);
```
