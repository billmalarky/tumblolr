# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"
Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  #=========================================================================================#
  #===================================== CONFIGURATION =====================================#
  #=========================================================================================#
  
  VB_NAME = "tumblolr_virtualbox"
  
  # HOSTNAME
  config.vm.hostname = "tumblolr.local"

  # INTERNAL NETWORK
  config.vm.network :private_network, ip: "192.168.100.100"
  #config.vm.network "forwarded_port", guest: 80, host: 8080

  # VM CONFIGURATION
  config.vm.box = "chef/fedora-19"
  
  config.vm.provider :virtualbox do |vb|
    vb.name = VB_NAME
    vb.customize ["modifyvm", :id, "--memory", "4096"]
  end


  # Run the provisioning script
  config.vm.provision :shell, :path => "vagrant/bootstrap.sh"
end
