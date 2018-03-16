<?php
namespace App\Controllers;

use App\Models\{Book,Author};

class BooksController extends BaseController{
    public function index()
    {
        $search = filter_input(INPUT_GET, 'search', FILTER_DEFAULT);
        // retrieves the books
        $books = Book::with('author')->orderBy('title');

        if ($search){
            $books->where('title', 'like', "%{$search}%");
        }

        // render the template
        return $this->render('index.html',[
            'books' => $books->get(),
            'search' => $search
        ]);
    }

    public function delete($id)
    {
        $item = Book::findOrFail($id);
        $item->delete();

        // show success message
        $this->flash('Book removed successfully');

        // redirects to listing
        header("Location: /");
        die();
    }

    public function create()
    {
        return $this->render('book.html');
    }

    public function view($id)
    {
        $book = Book::with('author')->findOrFail($id);
        return $this->render('book.html',[
            'book' => $book
        ]);
    }

    public function store($id=null)
    {
        $book = Book::findOrNew($id);
        $book->title = $_POST['title'];
        $book->description = $_POST['description'];
        $book->author()->associate(Author::firstOrCreate(['full_name'=>$_POST['author']]));
        $book->save();


        $this->flash($id?'Book saved successfully':'Book created successfully','success');

        // redirects to listing
        header("Location: /");
        die();
    }
}
