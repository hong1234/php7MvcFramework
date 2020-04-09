<?php

namespace Diva\Controllers;

//use Bookstore\Exceptions\DbException;
//use Bookstore\Exceptions\NotFoundException;
use Diva\Core\Request;
use Diva\Utils\DependencyInjector;
use Diva\Repository\ProductRepository;

class ProductController extends AbstractController {
    //const PAGE_LENGTH = 10;
    protected $repo;

    function __construct(DependencyInjector $di, Request $request){
        parent::__construct($di, $request);
        $this->repo = new ProductRepository($this->db);
    }

    // public function getAllWithPage($page): string {
    //     $page = (int)$page;
    //     $bookModel = new BookModel($this->db);

    //     $books = $bookModel->getAll($page, self::PAGE_LENGTH);

    //     $properties = [
    //         'books' => $books,
    //         'currentPage' => $page,
    //         'lastPage' => count($books) < self::PAGE_LENGTH
    //     ];
    //     return $this->render('books.twig', $properties);
    // }

    public function getAll(): string {
        $result = $this->repo->getAll();
        return $this->render('products.twig', $result);
    }

    // public function get(int $bookId): string {
    //     $bookModel = new BookModel($this->db);

    //     try {
    //         $book = $bookModel->get($bookId);
    //     } catch (\Exception $e) {
    //         $this->log->error('Error getting book: ' . $e->getMessage());
    //         $properties = ['errorMessage' => 'Book not found!'];
    //         return $this->render('error.twig', $properties);
    //     }

    //     $properties = ['book' => $book];
    //     return $this->render('book.twig', $properties);
    // }

    // public function search(): string {
    //     $title = $this->request->getParams()->getString('title');
    //     $author = $this->request->getParams()->getString('author');

    //     $bookModel = new BookModel($this->db);
    //     $books = $bookModel->search($title, $author);

    //     $properties = [
    //         'books' => $books,
    //         'currentPage' => 1,
    //         'lastPage' => true
    //     ];
    //     return $this->render('books.twig', $properties);
    // }

    public function returnProduct(int $productId): string {
        $result = $this->repo->getProductFeatures($productId);
        return $this->render('product.twig', $result);
    }
}