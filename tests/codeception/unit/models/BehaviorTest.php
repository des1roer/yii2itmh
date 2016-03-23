    <?php
    namespace models;
    use app\modules\video\models\Video;

    class BehaviorTest extends \Codeception\TestCase\Test
    {
        /**
         * @var \UnitTester
         */
        protected $tester;

        protected function _before()
        {
        }

        protected function _after()
        {
        }

        // tests
        public function testMe()
        {
            
            $video = Video::findOne(3);
            $this->assertEquals(0, count($video->id), 'Review count after save');
        }
    }