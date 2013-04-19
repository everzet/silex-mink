<?php

require_once 'MinkTestCase.php';

class ArticleTest extends MinkTestCase
{
    public function testThatArticleFormIsAccessible()
    {
        $this->getSession()->visit($_SERVER['BASE_URL'].'/');

        $this->getPage()->clickLink('Add article');

        $articleForm = $this->getPage()->find('css', 'form');
        $this->assertSession()->fieldExists('Title', $articleForm);
        $this->assertSession()->fieldExists('Body', $articleForm);
    }

    public function testArticlePreview()
    {
        $this->getSession()->visit($_SERVER['BASE_URL'].'/add-article');

        $this->getPage()->fillField('Title', 'Hello Mink!');
        $this->getPage()->fillField('Body', 'Func testing is fun!');
        $this->getPage()->pressButton('Preview');

        $previewArea = $this->getPage()->find('css', '.preview');
        $this->assertSession()->elementTextContains('css', '.preview', 'Hello Mink!');
        $this->assertSession()->elementTextContains('css', '.preview', 'Func testing is fun!');
    }

    public function testPreviewIsHiddentByDefault()
    {
        $this->getSession()->visit($_SERVER['BASE_URL'].'/add-article');

        $this->assertSession()->elementNotExists('css', '.preview');
    }
}
