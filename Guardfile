# Here is some notes about this file:
# http://www.deploymentzone.com/2011/05/24/guard-rspec-2-and-growl/
# http://www.weekeat.com/post/46061346286/symfony2-phpunit-with-guard
# More info at https://github.com/guard/guard#readme
guard 'phpunit',
          :keep_failed => true do
    watch(%r{^lib/(.+)\.php$}) { |m| "lib/#{m[1]}Test.php" }
end
