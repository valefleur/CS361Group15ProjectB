# Selenium WebDriver natively works on FireFox
# Other modules would need to be imported to work on other browsers
from selenium import webdriver
from selenium.webdriver.common.keys import Keys # allows access to keyboard keys

from selenium.common.exceptions import TimeoutException
from selenium.webdriver.support.ui import WebDriverWait # allows for timing control; waiting, sleeping, etc.
from selenium.webdriver.support import expected_conditions as EC # available since 2.26.0

# Create a new instance of the Firefox driver
driver = webdriver.Firefox()

# go to the google home page
driver.get("http://www.google.com")

# the page is ajaxy so the title is originally this:
print driver.title

# find the element that's name attribute is q (the google search box)
inputElement = driver.find_element_by_name("q")

# type in the search
inputElement.send_keys("cheese")

# submit the form (although google automatically searches now without submitting)
inputElement.submit()

try:
    # we have to wait for the page to refresh, the last thing that seems to be updated is the title
    WebDriverWait(driver, 10).until(EC.title_contains("cheese"))

    # You should see "cheese - Google Search"
    print driver.title

finally:
    driver.quit()

'''
browser = webdriver.Firefox()
browser.get("http://www.yahoo.com")
assert 'Yahoo' in browser.title

elem = browser.find_element_by_name('p') #find search box
elem.send_keys('seleniumhq' + Keys.RETURN)
'''



'''
class newAccountTestCase(unittest.TestCase):


	def test_is_username_present(self):
		self.assertTrue(document.GetElementById("username"))
		
		
if __name__ == '__main__':
	unittest.main()
	'''