Feature: I would like to edit dublin

  Scenario Outline: Insert records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/dublin/"
    Then I should not see "<dublin>"
     And I follow "Create a new entry"
    Then I should see "Dublin creation"
    When I fill in "Name" with "<dublin>"
     And I fill in "Caption" with "<caption>"
     And I fill in "Size" with "<size>"
     And I press "Create"
    Then I should see "<dublin>"
     And I should see "<caption>"
     And I should see "<size>"

  Examples:
    | dublin       | caption          | size |
    | Bow          | bow street       | 123  |
    | May Ln       | may ln street    | 234  |



  Scenario Outline: Edit records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/dublin/"
    Then I should not see "<new-dublin>"
    When I follow "<old-dublin>"
    Then I should see "<old-dublin>"
    When I follow "Edit"
     And I fill in "Name" with "<new-dublin>"
     And I fill in "Caption" with "<new-caption>"
     And I fill in "Size" with "<new-size>"
     And I press "Update"
     And I follow "Back to the list"
    Then I should see "<new-dublin>"
     And I should see "<new-caption>"
     And I should see "<new-size>"
     And I should not see "<old-dublin>"


  Examples:
    | old-dublin     | new-dublin    | new-caption   | new-size   |
    | Bow            | niewiadoma1   | zbedny opis   | 3453       |
    | May Ln         | niewiadoma2   | niewiadoma    | 4563       |

  Scenario Outline: Delete records
   Given I am on homepage
     And I follow "Login"
     And I fill in "Username" with "admin"
     And I fill in "Password" with "loremipsum"
     And I press "Login"
     And I go to "/admin/dublin/"
    Then I should see "<dublin>"
    When I follow "<dublin>"
    Then I should see "<dublin>"
    When I press "Delete"
    Then I should not see "<dublin>"


  Examples:
    |  dublin      |
    | niewiadoma1  |
    | niewiadoma2  |