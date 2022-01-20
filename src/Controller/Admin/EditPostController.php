<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\PostFactory;
use App\Exception\PostNotFoundException;
use App\Repository\PostRepository;
use App\Repository\TagRepository;
use Assert\Assertion;
use Assert\AssertionFailedException;

class EditPostController extends AdminController
{
    public function __invoke(array $parameters)
    {
        $postId = (int) $parameters['postId'];
        $post = PostRepository::getPost($postId);
        $tags = TagRepository::getTags();
        $errors = null;
        try {
            if (isset($_POST['post-modify-form'])) {
                $errors = $this->validateRegisterForm();
                if(empty($errors)) {
                    $editPost = PostRepository::editPost($this->updatePost($post));
                }
            }
            $this->render('editPost.twig', 'Admin', ['post' => $post, 'listTag' => $tags, 'errors' => $errors]);
        } catch (PostNotFoundException $exception) {
            $this->redirectToUrl();
        }
    }

    private function updatePost(Post $post)
    {
        $post->setTag(TagRepository::getTag($_POST['tag']));
        $post->setUser($this->getUser());
        $post->setTitle($_POST['title']);
        $post->setUpdatedAt(new \DateTime());
        $post->setChapo($_POST['chapo']);
        $post->setContent($_POST['content']);
        return $post;
    }

    private function validateRegisterForm(): array
    {
        $errors = [];

        $title = $_POST['title'];
        try {
            Assertion::notEmpty($title);
            Assertion::minLength($title, Post::TITLE_MIN_LENGTH);
        } catch (AssertionFailedException $exception) {
            $errors['title'] = "Le titre ne faire moins de " . Post::TITLE_MIN_LENGTH  . " caractères.";
        }

        $chapo = $_POST["chapo"];
        try {
            Assertion::notEmpty($chapo);
            Assertion::minLength($chapo, Post::CHAPO_MIN_LENGTH);
        } catch (AssertionFailedException $exception) {
            $errors['chapo'] = "Le chapo ne faire moins de " . Post::CHAPO_MIN_LENGTH  . " caractères.";
        }

        $content = $_POST["content"];
        try {
            Assertion::notEmpty($content);
            Assertion::minLength($content, Post::CONTENT_MIN_LENGTH);
        } catch (AssertionFailedException $exception) {
            $errors['content'] = "Le contenu ne faire moins de " . Post::CONTENT_MIN_LENGTH  . " caractères.";
        }

        $tag = $_POST["tag"];
        try {
            Assertion::notEmpty($tag);
        } catch (AssertionFailedException $exception) {
            $errors['tag'] = "Le contenu ne peut être vide";
        }

        return $errors;
    }

}