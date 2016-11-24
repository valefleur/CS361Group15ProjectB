# This is a basic unit test using Selenium
# Example 2 on https://pypi.python.org/pypi/selenium

from selenium import webdriver
import unittest # this installed with Python, we just need to reference it

# This test case will run against the website www.google.com
class GoogleTestCase(unittest.TestCase):

	# setUp code can be run before each test case is run.
	# This allows for the same environment, without code duplication.
    def setUp(self):
        self.browser = webdriver.Firefox()
        self.addCleanup(self.browser.quit)
	# self is a reference to the "test runner", or the process that runs all the tests.
	# It controls Selenium, which controls access to the webpage we're testing.

	# Test case 1
    def testPageTitle(self):
        self.browser.get('http://www.google.com')
        print "\n\nPage Title is: " + self.browser.title + "\n"
        self.assertIn('Google', self.browser.title)

if __name__ == '__main__':
    unittest.main(verbosity=2)